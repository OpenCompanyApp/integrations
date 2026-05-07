<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Stop one Sauce Labs real device job. */
class SauceLabsStopRdcJob extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_stop_rdc_job'; protected const DESCRIPTION = 'Stop one Sauce Labs real device job.'; protected const METHOD = 'stopRdcJob'; protected const ARGUMENTS = ['job_id']; }
