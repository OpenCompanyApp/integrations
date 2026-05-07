<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny post. */
class CannyRetrievePost extends AbstractCannyTool { protected const NAME = 'canny_retrieve_post'; protected const DESCRIPTION = 'Retrieve a Canny post by ID.'; protected const OPERATION = 'retrieve_post'; protected const REQUIRED = ['id']; }
