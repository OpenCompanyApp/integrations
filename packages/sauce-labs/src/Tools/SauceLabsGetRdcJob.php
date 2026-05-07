<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Get one Sauce Labs real device job. */
class SauceLabsGetRdcJob extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_rdc_job'; protected const DESCRIPTION = 'Get one Sauce Labs real device job.'; protected const METHOD = 'getRdcJob'; protected const ARGUMENTS = ['job_id']; }
