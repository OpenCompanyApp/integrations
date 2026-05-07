<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Execute a safe relative Codemagic API POST call. */
class CodemagicApiPost extends AbstractCodemagicTool { protected const NAME = 'codemagic_api_post'; protected const DESCRIPTION = 'Call a safe relative Codemagic API POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
