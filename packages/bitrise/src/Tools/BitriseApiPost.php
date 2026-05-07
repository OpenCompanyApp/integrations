<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Execute a safe relative Bitrise API POST call. */
class BitriseApiPost extends AbstractBitriseTool { protected const NAME = 'bitrise_api_post'; protected const DESCRIPTION = 'Call a safe relative Bitrise API POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
