<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLinksTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('links', ['id' => 'id']);
        $table
            ->addColumn('code', 'string', ['length' => 10])
            ->addColumn('target', 'string', ['length' => 255])
            ->addTimestamps()
            ->create();
    }
}
