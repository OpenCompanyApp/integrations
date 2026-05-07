<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Delete one Sauce Labs VDC job. */
class SauceLabsDeleteJob extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_delete_job'; protected const DESCRIPTION = 'Delete one Sauce Labs VDC job and assets.'; protected const METHOD = 'deleteJob'; protected const ARGUMENTS = ['username', 'job_id']; }
