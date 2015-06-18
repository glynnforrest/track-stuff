<?php

namespace TrackStuff\Migrations;

use Neptune\Database\Migration\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Migration20150618081427CreateGoalsTable extends AbstractMigration
{
    protected $description = 'Create goals table';

    public function up(Schema $schema)
    {
        $table = $schema->createTable('goals');

        $id = $table->addColumn('id', 'integer', ['unsigned' => true]);
        $id->setAutoIncrement(true);
        $table->setPrimaryKey(['id']);
        $table->addColumn('title', 'string');
        $table->addColumn('slug', 'string');

        return $schema;
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('goals');
    }
}
