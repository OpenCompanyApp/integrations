<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Enqueue feedback for Canny Autopilot. */
class CannyEnqueueFeedback extends AbstractCannyTool { protected const NAME = 'canny_enqueue_feedback'; protected const DESCRIPTION = 'Enqueue feedback for Canny Autopilot extraction and deduplication.'; protected const OPERATION = 'enqueue_feedback'; protected const REQUIRED = ['type', 'payload']; }
