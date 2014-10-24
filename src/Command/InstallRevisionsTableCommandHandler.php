<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Command;

use Illuminate\Database\Schema\Blueprint;

class InstallRevisionsTableCommandHandler
{
    protected $db;

    protected $schema;

    function __construct()
    {
        $this->db     = app('db');
        $this->schema = app('db')->connection()->getSchemaBuilder();
    }

    public function handle(InstallRevisionsTableCommand $command)
    {
        $this->installRevisionsTable();
    }

    protected function installRevisionsTable()
    {
        $this->schema->dropIfExists('revision_history');

        $this->schema->create(
            'revision_history',
            function (Blueprint $table) {

                $table->increments('id');
                $table->datetime('created_at')->nullable();
                $table->datetime('updated_at')->nullable();
                $table->string('revisionable_type');
                $table->integer('revisionable_id');
                $table->integer('user_id')->nullable();
                $table->string('key');
                $table->text('old_value')->nullable();
                $table->text('new_value')->nullable();

            }
        );
    }
}
 