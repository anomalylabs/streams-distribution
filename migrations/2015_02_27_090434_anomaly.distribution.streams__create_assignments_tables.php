<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

/**
 * Class AnomalyDistributionStreamsCreateAssignmentsTables
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyDistributionStreamsCreateAssignmentsTables extends Migration
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

        if (!$schema->hasTable('streams_assignments')) {
            $schema->create(
                'streams_assignments',
                function (Blueprint $table) {

                    $table->increments('id');
                    $table->integer('sort_order');
                    $table->integer('stream_id');
                    $table->integer('field_id');
                    $table->string('label')->nullable();
                    $table->text('instructions')->nullable();
                    $table->boolean('unique')->default(0);
                    $table->boolean('required')->default(0);
                    $table->boolean('translatable')->default(0);
                }
            );
        }

        if (!$schema->hasTable('streams_assignments_translations')) {
            $schema->create(
                'streams_assignments_translations',
                function (Blueprint $table) {

                    $table->increments('id');
                    $table->integer('assignment_id');
                    $table->string('locale')->index();

                    $table->string('label')->nullable();
                    $table->text('instructions')->nullable();
                }
            );
        }
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

        $schema->dropIfExists('streams_assignments');
        $schema->dropIfExists('streams_assignments_translations');
    }
}
