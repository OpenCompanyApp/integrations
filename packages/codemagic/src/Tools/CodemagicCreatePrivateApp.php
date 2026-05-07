<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Add a private repository to Codemagic. */
class CodemagicCreatePrivateApp extends AbstractCodemagicTool { protected const NAME = 'codemagic_create_private_app'; protected const DESCRIPTION = 'Add a private Git repository to Codemagic using SSH key details.'; protected const METHOD = 'createPrivateApp'; protected const REQUIRED = ['payload']; protected const USE_PAYLOAD = true; }
