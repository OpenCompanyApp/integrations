<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Execute a safe relative Bitrise API DELETE call. */
class BitriseApiDelete extends AbstractBitriseTool { protected const NAME = 'bitrise_api_delete'; protected const DESCRIPTION = 'Call a safe relative Bitrise API DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
