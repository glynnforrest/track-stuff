<?php

namespace TrackStuff\Migrations;

use Neptune\Database\Migration\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Migration20150622080534CreateGoalLogTable extends AbstractMigration
{
    protected $description = 'Create goal log table';

    public function up(Schema $schema)
    {
        $table = $schema->createTable('goal_logs');

        $id = $table->addColumn('id', 'integer', ['unsigned' => true]);
        $id->setAutoIncrement(true);
        $table->setPrimaryKey(['id']);

        $table->addColumn('date', 'date');
        $table->addColumn('goal_id', 'integer', ['unsigned' => true]);
        $table->addColumn('amount', 'integer', ['unsigned' => true]);

        return $schema;
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('goal_logs');
    }

}
