<?php namespace Anomaly\StreamsDistribution\Http\Controller;

use cebe\markdown\Markdown;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

class LicenseController extends PublicController
{
    /**
     * Verify agreement with license.
     *
     * @return mixed
     */
    public function index()
    {
        $license = (new Markdown())->parse(file_get_contents(app('streams.path') . '/LICENSE'));

        return view('distribution::license', compact('license'));
    }
}
