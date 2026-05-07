<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Delete one Appetize app. */
class AppetizeDeleteApp extends AbstractAppetizeTool { protected const NAME = 'appetize_delete_app'; protected const DESCRIPTION = 'Delete one Appetize app by publicKey.'; protected const METHOD = 'deleteApp'; protected const ARGUMENTS = ['public_key']; }
