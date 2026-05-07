<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** List Codemagic app caches. */
class CodemagicListCaches extends AbstractCodemagicTool { protected const NAME = 'codemagic_list_caches'; protected const DESCRIPTION = 'List storage caches for a Codemagic application.'; protected const METHOD = 'listCaches'; protected const ARGUMENTS = ['app_id']; }
