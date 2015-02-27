<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

/**
 * Class AnomalyDistributionStreamsCreateStreamsTables
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyDistributionStreamsCreateStreamsTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* @var Builder $schema */
        $schema = app('db')->connection()->getSchemaBuilder();

        $schema->create(
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
                $table->string('locked')->default(0);
                $table->string('translatable')->default(0);
                $table->string('revisionable')->default(0);
            }
        );

        $schema->create(
            'streams_streams_translations',
            function (Blueprint $table) {

                $table->increments('id');
                $table->integer('stream_id');
                $table->string('locale')->index();

                $table->string('name');
                $table->string('description')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* @var Builder $schema */
        $schema = app('db')->connection()->getSchemaBuilder();

        $schema->dropIfExists('streams_streams');
        $schema->dropIfExists('streams_streams_translations');
    }
}
