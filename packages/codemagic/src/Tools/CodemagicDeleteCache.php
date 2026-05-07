<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Delete one Codemagic app cache. */
class CodemagicDeleteCache extends AbstractCodemagicTool { protected const NAME = 'codemagic_delete_cache'; protected const DESCRIPTION = 'Delete one storage cache for a Codemagic application.'; protected const METHOD = 'deleteCache'; protected const ARGUMENTS = ['app_id', 'cache_id']; }
