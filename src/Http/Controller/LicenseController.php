<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Http\Controller;

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
        $license = (new Markdown())->parse(file_get_contents(streams_path('LICENSE')));

        return view('distribution.base::license', compact('license'));
    }
}