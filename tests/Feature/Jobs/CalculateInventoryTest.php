<?php

use App\Models\DetailSpk;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Support\Facades\Artisan;
use LogicException;

beforeEach(fn () => Artisan::call('db:seed', ['--class' => 'DummySeeder']));

it('can calculate stock when finished goods created', function () {
    // Arrange & act
    $detailSpk = DetailSpk::factory()->create();

    // Assert
    $inventory = Inventory::gudangHasil()->where('id_buku', $detailSpk->id_buku)->first();
    expect($inventory)->not->toBeNull();
    expect($inventory->stok)->toBe($detailSpk->qty);

    $transaction = Transaction::where('transactionable_type', $detailSpk->getMorphClass())
        ->where('transactionable_id', $detailSpk->id)
        ->first();
    expect($transaction)->not->toBeNull();
    expect($transaction->qty)->toBe($detailSpk->qty);
    expect($transaction->id_inventory)->toBe($inventory->id);

    // Arrange & act
    $detailSpk2 = DetailSpk::factory()->create([
        'id_spk' => $detailSpk->id_spk,
        'id_buku' => $detailSpk->id_buku,
    ]);

    // Assert
    $inventory2 = Inventory::gudangHasil()->where('id_buku', $detailSpk2->id_buku)->first();
    expect($inventory2)->not->toBeNull();
    expect($inventory2->id)->toBe($inventory->id);
    expect($inventory2->stok)->toBe($inventory->stok + $detailSpk2->qty);

    $transaction2 = Transaction::where('transactionable_type', $detailSpk2->getMorphClass())
        ->where('transactionable_id', $detailSpk2->id)
        ->first();
    expect($transaction2)->not->toBeNull();
    expect($transaction2->qty)->toBe($detailSpk2->qty);
    expect($transaction2->id_inventory)->toBe($inventory2->id);
});

it('can calculate stock when finished goods updated', function () {
    // Arrange
    $qty = random_int(50, 60);
    $qty2 = random_int(30, 49);
    $detailSpk = DetailSpk::factory()->create([
        'qty' => $qty,
    ]);
    $detailSpk2 = DetailSpk::factory()->create([
        'id_spk' => $detailSpk->id_spk,
        'id_buku' => $detailSpk->id_buku,
        'qty' => $qty2,
    ]);

    $inventory = Inventory::gudangHasil()->where('id_buku', $detailSpk->id_buku)->first();
    expect($inventory)->not->toBeNull();
    expect($inventory->stok)->toBe($qty + $qty2);

    $transaction = Transaction::where('transactionable_type', $detailSpk->getMorphClass())
        ->where('transactionable_id', $detailSpk->id)
        ->first();
    expect($transaction)->not->toBeNull();
    expect($transaction->qty)->toBe($qty);
    expect($transaction->id_inventory)->toBe($inventory->id);

    $transaction2 = Transaction::where('transactionable_type', $detailSpk2->getMorphClass())
        ->where('transactionable_id', $detailSpk2->id)
        ->first();
    expect($transaction2)->not->toBeNull();
    expect($transaction2->qty)->toBe($qty2);
    expect($transaction2->id_inventory)->toBe($inventory->id);

    // act
    $detailSpk->update([
        'qty' => $qty + 30,
    ]);
    $detailSpk2->update([
        'qty' => $qty - 10,
    ]);

    // Assert
    $detailSpk->refresh();
    $detailSpk2->refresh();
    $inventory->refresh();
    $transaction->refresh();
    $transaction2->refresh();
    expect($inventory->stok)->toBe($detailSpk->qty + $detailSpk2->qty);
    expect($transaction->qty)->toBe($detailSpk->qty);
    expect($transaction2->qty)->toBe($detailSpk2->qty);

    // act
    $detailSpk->update([
        'qty' => $qty - 10,
    ]);
    $detailSpk2->update([
        'qty' => $qty + 15,
    ]);

    // Assert
    $detailSpk->refresh();
    $detailSpk2->refresh();
    $inventory->refresh();
    $transaction->refresh();
    $transaction2->refresh();
    expect($inventory->stok)->toBe($detailSpk->qty + $detailSpk2->qty);
    expect($transaction->qty)->toBe($detailSpk->qty);
    expect($transaction2->qty)->toBe($detailSpk2->qty);
});

it('can\'t update finished goods qty when stock below qty', function () {
    // Arrange
    $qty = random_int(50, 60);
    $detailSpk = DetailSpk::factory()->create([
        'qty' => $qty,
    ]);

    $inventory = Inventory::gudangHasil()->where('id_buku', $detailSpk->id_buku)->first();
    expect($inventory)->not->toBeNull();
    expect($inventory->stok)->toBe($qty);

    $transaction = Transaction::where('transactionable_type', $detailSpk->getMorphClass())
        ->where('transactionable_id', $detailSpk->id)
        ->first();
    expect($transaction)->not->toBeNull();
    expect($transaction->qty)->toBe($qty);
    expect($transaction->id_inventory)->toBe($inventory->id);

    $detailSpk->qty = $qty + 100;

    // act & assert
    expect(fn () => $detailSpk->save())->not->toThrow(LogicException::class);

    // arrange
    $inventory->update([
        'stok' => 0,
    ]);
    $detailSpk->qty = $qty - 100; // inventory minus

    // act & assert
    expect(fn () => $detailSpk->save())->toThrow(LogicException::class);
});
