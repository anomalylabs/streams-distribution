<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Command;

use Illuminate\Database\Schema\Blueprint;

class InstallStreamsCommandHandler
{
    protected $db;

    protected $schema;

    function __construct()
    {
        $this->db     = app('db');
        $this->schema = app('db')->connection()->getSchemaBuilder();
    }

    public function handle(InstallStreamsCommand $command)
    {
        $this->installStreamsTable();
        $this->installFieldsTable();
        $this->installAssignmentsTable();
    }

    protected function installStreamsTable()
    {
        $this->schema->dropIfExists('streams_streams');

        $this->schema->create(
            'streams_streams',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('namespace');
                $table->string('slug');
                $table->string('prefix')->nullable();
                $table->string('name');
                $table->string('description')->nullable();
                $table->text('view_options');
                $table->string('title_column');
                $table->string('order_by');
                $table->string('is_hidden')->default(0);
                $table->string('is_translatable')->default(0);
                $table->string('is_revisionable')->default(0);

            }
        );
    }

    protected function installFieldsTable()
    {
        $this->schema->dropIfExists('streams_fields');

        $this->schema->create(
            'streams_fields',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('namespace');
                $table->string('slug');
                $table->string('name');
                $table->string('type');
                $table->text('settings');
                $table->text('rules');
                $table->string('is_locked')->default(0);

            }
        );
    }

    protected function installAssignmentsTable()
    {
        $this->schema->dropIfExists('streams_assignments');

        $this->schema->create(
            'streams_assignments',
            function (Blueprint $table) {

                $table->increments('id');
                $table->integer('sort_order');
                $table->integer('stream_id');
                $table->integer('field_id');
                $table->string('name');
                $table->text('instructions');
                $table->text('settings');
                $table->text('rules');
                $table->string('is_translatable')->default(0);
                $table->string('is_revisionable')->default(0);

            }
        );
    }
}
 