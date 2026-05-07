<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Execute a safe relative Bitrise API PATCH call. */
class BitriseApiPatch extends AbstractBitriseTool { protected const NAME = 'bitrise_api_patch'; protected const DESCRIPTION = 'Call a safe relative Bitrise API PATCH path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPatch'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
