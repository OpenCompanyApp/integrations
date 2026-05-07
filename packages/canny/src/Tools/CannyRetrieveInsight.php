<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny insight. */
class CannyRetrieveInsight extends AbstractCannyTool { protected const NAME = 'canny_retrieve_insight'; protected const DESCRIPTION = 'Retrieve a Canny insight by ID.'; protected const OPERATION = 'retrieve_insight'; protected const REQUIRED = ['id']; }
