<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Stop one Sauce Labs VDC job. */
class SauceLabsStopJob extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_stop_job'; protected const DESCRIPTION = 'Stop one Sauce Labs VDC job.'; protected const METHOD = 'stopJob'; protected const ARGUMENTS = ['username', 'job_id']; }
