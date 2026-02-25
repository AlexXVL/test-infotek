<?php

use App\Modules\Slot\Models\Slot;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName;

    public function __construct()
    {
        $this->tableName = (new Slot())->getTable();
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('capacity')
                ->nullable(false)
                ->comment('вместимость слота');

            $table->unsignedTinyInteger('remaining')
                ->nullable(false)
                ->comment('текущее количество доступных слотов');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
