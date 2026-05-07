<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Get one Sauce Labs VDC job. */
class SauceLabsGetJob extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_job'; protected const DESCRIPTION = 'Get one Sauce Labs VDC job.'; protected const METHOD = 'getJob'; protected const ARGUMENTS = ['username', 'job_id']; }
