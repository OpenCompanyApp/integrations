<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Delete one BrowserStack Automate build. */
class BrowserStackDeleteBuild extends AbstractBrowserStackTool { protected const NAME = 'browserstack_delete_build'; protected const DESCRIPTION = 'Delete one BrowserStack Automate build by id.'; protected const METHOD = 'deleteBuild'; protected const ARGUMENTS = ['build_id']; }
