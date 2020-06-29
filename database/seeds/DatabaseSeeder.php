<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables(['tasks']);

        $this->call(TaskSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        // Desactiva revisión de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        // Activa revisión de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
