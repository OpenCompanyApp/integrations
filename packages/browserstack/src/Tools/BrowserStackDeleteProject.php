<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Delete a BrowserStack Automate project. */
class BrowserStackDeleteProject extends AbstractBrowserStackTool { protected const NAME = 'browserstack_delete_project'; protected const DESCRIPTION = 'Delete one BrowserStack Automate project.'; protected const METHOD = 'deleteProject'; protected const ARGUMENTS = ['project_id']; }
