<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Get one BrowserStack Automate project. */
class BrowserStackGetProject extends AbstractBrowserStackTool { protected const NAME = 'browserstack_get_project'; protected const DESCRIPTION = 'Get one BrowserStack Automate project by project id.'; protected const METHOD = 'getProject'; protected const ARGUMENTS = ['project_id']; }
