<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Get one Sauce Labs VDC job asset. */
class SauceLabsGetJobAsset extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_job_asset'; protected const DESCRIPTION = 'Get one Sauce Labs VDC job asset file such as log.json or video.mp4.'; protected const METHOD = 'getJobAsset'; protected const ARGUMENTS = ['username', 'job_id', 'file_name']; }
