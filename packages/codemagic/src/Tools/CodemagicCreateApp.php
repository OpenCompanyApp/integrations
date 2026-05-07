<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Add a repository to Codemagic. */
class CodemagicCreateApp extends AbstractCodemagicTool { protected const NAME = 'codemagic_create_app'; protected const DESCRIPTION = 'Add a Git repository to Codemagic applications.'; protected const METHOD = 'createApp'; protected const REQUIRED = ['payload']; protected const USE_PAYLOAD = true; }
