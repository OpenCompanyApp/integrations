<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Update one Sauce Labs VDC job. */
class SauceLabsUpdateJob extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_update_job'; protected const DESCRIPTION = 'Update one Sauce Labs VDC job metadata.'; protected const METHOD = 'updateJob'; protected const ARGUMENTS = ['username', 'job_id']; protected const REQUIRED = ['username', 'job_id', 'payload']; protected const USE_PAYLOAD = true; }
