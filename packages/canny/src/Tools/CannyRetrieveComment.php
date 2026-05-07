<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny comment. */
class CannyRetrieveComment extends AbstractCannyTool { protected const NAME = 'canny_retrieve_comment'; protected const DESCRIPTION = 'Retrieve a Canny comment by ID.'; protected const OPERATION = 'retrieve_comment'; protected const REQUIRED = ['id']; }
