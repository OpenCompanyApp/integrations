<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Delete all Codemagic app caches. */
class CodemagicDeleteCaches extends AbstractCodemagicTool { protected const NAME = 'codemagic_delete_caches'; protected const DESCRIPTION = 'Delete all storage caches for a Codemagic application.'; protected const METHOD = 'deleteCaches'; protected const ARGUMENTS = ['app_id']; }
