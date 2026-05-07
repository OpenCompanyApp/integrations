<?php

namespace OpenCompany\Integrations\SmartRecruiters;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApplyCreateCandidate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApplyGetApplyConfigurationForPosting;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApplyGetApplicationStatus;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApprovalsApprovalsGetById;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApprovalsApprovalsCommentsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApprovalsApprovalsCommentsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApprovalsApprovalsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApprovalsApprovalsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApprovalsApprovalsApprove;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersApprovalsApprovalsReject;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentsOrdersGetList;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAuditAuditGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationAccessGroupCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationAccessGroupList;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationAccessGroupGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationAccessGroupUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationAccessGroupDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCompanyMy;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesTranslationsPatch;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesDeprecatedArchive;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesDeprecatedUnarchive;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesTranslationsPatch;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesArchive;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesValuesUnarchive;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesActivate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDeactivate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDependentsAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDependentsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDependentsRemove;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesAdd;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesRemove;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationDepartmentCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationDepartmentAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationDepartmentGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationHiringProcessAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationHiringProcessGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationOfferPropertiesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCandidatePropertiesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCandidatePropertiesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationSourceTypes;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationSourceValuesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationSourceValuesSingle;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationSourceValuesSingleByIdentifier;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationSourceValuesRecruiterSourceByName;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationReasonsRejectionAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationReasonsWithdrawalAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCareersitesList;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationCareersitesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationPredefinedLocationsGetMany;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationPredefinedLocationsCreateOne;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationPredefinedLocationsDeleteMany;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationPredefinedLocationsGetOne;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationPredefinedLocationsUpdateOne;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersConfigurationConfigurationPredefinedLocationsDeleteOne;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTypesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTypesUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTypesDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsInterviewsGetList;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsInterviewsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsInterviewsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsInterviewsUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsInterviewsDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTimeslotsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTimeslotsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTimeslotsUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTimeslotsDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsStatusesCandidatePut;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsStatusesInterviewerPut;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsTimeslotsPatchNoshow;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewsStatusesTimeslotCandidatePut;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPositionsAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPositionsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPositionsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPositionsUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPositionsRemove;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsJobadsAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsJobadsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsJobadsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsJobadsUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsJobadsPostingsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsJobadsPostingsAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsJobadsPostingsUnpublish;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPublicationCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPublicationUnpublish;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPublicationAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsHiringTeamGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsHiringTeamAdd;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsHiringTeamRemove;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsNotesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsNotesUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsHeadcountUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsPatch;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsStatusUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsStatusHistoryGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsApprovalsLatest;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesTagsAdd;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesTagsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesTagsReplace;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesTagsDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesOnboardingGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesOnboardingUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesOnboardingGetForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesOnboardingUpdateForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAdd;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesResumeAdd;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesResumeParse;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesConsentRequestBatch;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesConsentStatus;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesConsentDecisions;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAttachmentsList;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAttachmentsAdd;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAttachmentsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAttachmentsListForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAttachmentsAddForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAttachmentsGetForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAttachmentsDeleteForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesStatusUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesStatusUpdatePrimary;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesStatusHistoryGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesStatusHistoryGetForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesSourceUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesPropertiesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesPropertiesGetForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesPropertiesValuesBatchUpdateForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesPropertiesValuesUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesPropertiesValuesUpdateForJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesScreeningAnswersGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAddToJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesResumeAddToJob;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesGetApplication;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesDeleteApplication;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobApplicationsJobApplicationsGetById;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobApplicationsJobApplicationsDeleteById;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobApplicationsJobApplicationsPostConsentRequest;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobApplicationsJobApplicationsGetConsentDecision;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersMessagesMessagesSharesCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersMessagesMessagesSharesDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersMessagesMessagesFetch;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReviewsScorecardsCriteriaGetByJobId;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReviewsReviewsGetList;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReviewsReviewsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReviewsReviewsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReviewsReviewsUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReviewsReviewsDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingGetReportFiles;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingGenerateAdHocReport;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingGetReports;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingGetReport;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingGetMostRecentReportFile;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingDownloadMostRecentReportFile;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingGetReportFile;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersReportingDownloadReportFile;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersMe;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersActivationDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersActivationEmailSend;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersActivationActivate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersActivationDeactivate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersApiDeprecatedUsersAvatarUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardNewHiresGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardOnboardingProcessesGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardWebFormAssignmentsFormAnswersGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardWebFormAssignmentsFieldsMetadataGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardFillablePdfFormAssignmentsFormAnswersGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardOnboardingProcessesAssignmentsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardOnboardingProcessesAssignmentGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardActivityAssignmentsAttachmentsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSmartonboardActivityAssignmentsAttachmentsGetById;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersMe;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersPasswordReset;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersActivationEmailSend;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersActivationActivate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersActivationDeactivate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersUsersAvatarUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersSystemRolesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersAccessGroupsAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersAccessGroupsUsersRemove;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUsersAccessGroupsUsersAssign;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsGetAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsDelete;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsActivate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsGenerateSecretKey;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsGetSecretKey;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersWebhooksSubscriptionsSearchCallbackLog;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerGetPartnerConfig;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerSavePartnerConfig;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerSetUpIntegration;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerPackageResultUpdate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAddAttachmentToOrder;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementGetEventDetails;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementUpdateEvent;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementDeleteEvent;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementAddInterviewersToSession;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementRemoveInterviewersFromSession;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementMoveApplicantsToSession;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementAddApplicantsToSession;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementGetEvents;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementCreateEvent;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementGetAllApplicants;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementAddApplicantsToEvent;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementGetSessionDetails;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementDeleteSession;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementGetApplicantsByEventId;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementGetEventsForCandidate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEventManagementGetEventsForApplication;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAppAskForConsent;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAppDeleteIntegration;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAppListPackages;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAppGetPackageById;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAppOrdersAssessmentPackage;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAppOrdersInlineAssessmentPackage;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAssessmentPartnerAppGetToken;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersAppsIntegrationsEnableIntegration;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidateStatusGetStatus;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersFeedFindPostingUsingJson;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersFeedUpdatePostingUsingJson;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersFeedPostingsJsonStream;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesGetTemplateById;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesUpdateTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesDeleteTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesGetJobManagedSteps;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesUpdateJobManagedSteps;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesUpdateJobTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesPatchJobTemplateInterviewers;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesFindJobTemplateByHiringState;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesUpsertJobTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesGetInterviewTemplateById;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesUpdateInterviewTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesDeleteInterviewTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesUpdateJobInterviewTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesUpdateJobInterviewTemplateInterviewers;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesGetTemplates;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesCreateTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesSearchJobTemplateByJobApplicationIds;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesSearchInterviewTemplates;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesCreateInterviewTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesGetSchedulePreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesFindJobTemplatesByJobId;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesFindJobTemplateByApplicationId;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesGetJobInterviewTemplates;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersInterviewTemplatesGetJobApplicationInterviewTemplates;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersOffersCandidatesOffersAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersOffersCandidatesOffersGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersOffersCandidatesOffersApprovalsLatest;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersOffersCandidatesOffersFind;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersOffersOffersDocumentsGetDocumentsList;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersOffersOffersDocumentsGetDocument;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPartnersPublicGetConfigs;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPartnersPublicAddConfig;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPartnersPublicGetConfig;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPartnersPublicUpdateConfig;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPartnersPublicSearchOffers;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPostingV1ListPostings;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPostingV1GetPosting;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPostingV1ListDepartments;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingGetSelfScheduledInterview;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingUpdateSelfScheduleInterview;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingCreateSelfScheduleInterview;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingAutomatedSelfScheduling;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingGetAutomatedSchedulesAvailableSlotsCountByInterviewerWithRoles;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingUpdateSelfScheduleInvite;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingRequestSelfReschedule;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingSearchSelfSchedules;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingGetSelfSchedule;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingCancelSelfSchedule;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingGetApplicationSelfSchedule;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersSelfSchedulingAvailableSlotsForApplication;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersUrlShortenerPublicShorten;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsGetEmployeePreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsSaveEmployeePreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsUpsertEmployeePreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsFindGlobalPreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsUpsertGlobalPreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsUpdateEmployeePreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsFindAllNotificationTypes;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersNotificationsGetAllEmployeePreferences;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEmailCompanyGetMessageTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEmailCompanyUpdateMessageTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEmailCompanyRemoveMessageTemplate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEmailCompanyGetMessageTemplates;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersEmailCompanyCreateMessageTemplate;

/**
 * Tool catalog and configuration metadata for SmartRecruiters.
 *
 * Exposes official SmartRecruiters OpenAPI registry operations as endpoint-specific
 * tools and resolves account-specific API key or OAuth credentials.
 */
class SmartRecruitersToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key_or_oauth', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => true, 'header' => 'x-smarttoken', 'token_keys' => ['api_key', 'access_token', 'client_id', 'client_secret'], 'notes' => ['Customer APIs accept x-smarttoken API keys or OAuth bearer tokens depending on the endpoint family and scope.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'smartrecruiters'; }
    public function appMeta(): array { return ['label' => 'SmartRecruiters', 'description' => 'Recruiting jobs, candidates, applications, configuration, interviews, reporting, users, offers, webhooks, and marketplace APIs', 'icon' => 'ph:briefcase', 'logo' => 'ph:briefcase']; }
    public function integrationMeta(): array { return ['name' => 'SmartRecruiters', 'description' => 'Manage SmartRecruiters API resources across jobs, candidates, applications, configuration, interviews, reporting, users, offers, webhooks, assessments, approvals, and marketplace APIs.', 'icon' => 'ph:briefcase', 'logo' => 'ph:briefcase', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.smartrecruiters.com/docs/api-reference']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'SmartRecruiters x-smarttoken', 'hint' => 'Optional when using OAuth access token or client credentials.', 'required' => false], ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'OAuth bearer token', 'required' => false], ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'required' => false], ['key' => 'client_secret', 'type' => 'secret', 'label' => 'Client Secret', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.smartrecruiters.com', 'default' => 'https://api.smartrecruiters.com', 'required' => false], ['key' => 'token_url', 'type' => 'url', 'label' => 'OAuth Token URL', 'placeholder' => 'https://api.smartrecruiters.com/identity/oauth/token', 'default' => 'https://api.smartrecruiters.com/identity/oauth/token', 'required' => false]]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.smartrecruiters.com'), '/');
        $apiKey = (string) ($config['api_key'] ?? '');
        $accessToken = (string) ($config['access_token'] ?? '');
        if ($apiKey === '' && $accessToken === '') { return ['success' => false, 'error' => 'Provide a SmartRecruiters API key or access token.']; }

        try {
            $headers = ['Accept' => 'application/json'];
            if ($apiKey !== '') { $headers['x-smarttoken'] = $apiKey; } else { $headers['Authorization'] = 'Bearer ' . $accessToken; }
            $response = Http::withHeaders($headers)->timeout(10)->get($baseUrl . '/jobs', ['limit' => 1]);
            if (!$response->successful()) { return ['success' => false, 'error' => 'SmartRecruiters API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to SmartRecruiters at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'access_token' => 'nullable|string', 'client_id' => 'nullable|string', 'client_secret' => 'nullable|string', 'url' => 'nullable|url', 'token_url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            "smartrecruiters_apply_create_candidate" => [
                'class' => SmartRecruitersApplyCreateCandidate::class,
                'name' => "Create a New Candidate Application",
                'description' => "Create a New Candidate Application\n\nOfficial SmartRecruiters endpoint: POST /postings/{uuid}/candidates from apply-api.json.",
                'parameters' => [
                    "uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Posting UUID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters apply-api.json schema for Create a New Candidate Application.",
                    ],
                ],
            ],
            "smartrecruiters_apply_get_apply_configuration_for_posting" => [
                'class' => SmartRecruitersApplyGetApplyConfigurationForPosting::class,
                'name' => "Get application configuration for posting",
                'description' => "Get application configuration for posting\n\nOfficial SmartRecruiters endpoint: GET /postings/{uuid}/configuration from apply-api.json.",
                'parameters' => [
                    "accept_language" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Language for screening questions. By default 'en'.",
                    ],
                    "uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Posting UUID",
                    ],
                    "conditionals_included" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "Specifies whether conditional questions should be returned in the response. 'false' if not specified",
                    ],
                ],
            ],
            "smartrecruiters_apply_get_application_status" => [
                'class' => SmartRecruitersApplyGetApplicationStatus::class,
                'name' => "Get candidate status",
                'description' => "Get candidate status\n\nOfficial SmartRecruiters endpoint: GET /postings/{uuid}/candidates/{candidateId}/status from apply-api.json.",
                'parameters' => [
                    "uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Posting UUID",
                    ],
                    "candidate_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `candidateId`.",
                    ],
                ],
            ],
            "smartrecruiters_approvals_approvals_get_by_id" => [
                'class' => SmartRecruitersApprovalsApprovalsGetById::class,
                'name' => "Get approval request by id",
                'description' => "Get approval request by id\n\nOfficial SmartRecruiters endpoint: GET /approvals/{approvalRequestId} from approvals-api.json.",
                'parameters' => [
                    "approval_request_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Approval request identifier",
                    ],
                ],
            ],
            "smartrecruiters_approvals_approvals_comments_get" => [
                'class' => SmartRecruitersApprovalsApprovalsCommentsGet::class,
                'name' => "Get comments for given approval request",
                'description' => "Get comments for given approval request\n\nOfficial SmartRecruiters endpoint: GET /approvals/{approvalRequestId}/comments from approvals-api.json.",
                'parameters' => [
                    "approval_request_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Approval request identifier",
                    ],
                ],
            ],
            "smartrecruiters_approvals_approvals_comments_create" => [
                'class' => SmartRecruitersApprovalsApprovalsCommentsCreate::class,
                'name' => "Add comment to given approval request",
                'description' => "Add comment to given approval request\n\nOfficial SmartRecruiters endpoint: POST /approvals/{approvalRequestId}/comments from approvals-api.json.",
                'parameters' => [
                    "approval_request_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Approval request identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters approvals-api.json schema for Add comment to given approval request.",
                    ],
                ],
            ],
            "smartrecruiters_approvals_approvals_get" => [
                'class' => SmartRecruitersApprovalsApprovalsGet::class,
                'name' => "Get pending approvals requests where you are an approver.",
                'description' => "Get pending approvals requests where you are an approver.\n\nOfficial SmartRecruiters endpoint: GET /approvals from approvals-api.json.",
                'parameters' => [
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Identifier for the paged list of approval requests. To get the first page of approval request, leave it blank.",
                    ],
                ],
            ],
            "smartrecruiters_approvals_approvals_create" => [
                'class' => SmartRecruitersApprovalsApprovalsCreate::class,
                'name' => "Create approval request",
                'description' => "Create approval request\n\nOfficial SmartRecruiters endpoint: POST /approvals from approvals-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters approvals-api.json schema for Create approval request.",
                    ],
                ],
            ],
            "smartrecruiters_approvals_approvals_approve" => [
                'class' => SmartRecruitersApprovalsApprovalsApprove::class,
                'name' => "Approve the approval request by id",
                'description' => "Approve the approval request by id\n\nOfficial SmartRecruiters endpoint: POST /approvals/{approvalRequestId}/approve-decisions from approvals-api.json.",
                'parameters' => [
                    "approval_request_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Approval request identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters approvals-api.json schema for Approve the approval request by id.",
                    ],
                ],
            ],
            "smartrecruiters_approvals_approvals_reject" => [
                'class' => SmartRecruitersApprovalsApprovalsReject::class,
                'name' => "Reject the approval request by id",
                'description' => "Reject the approval request by id\n\nOfficial SmartRecruiters endpoint: POST /approvals/{approvalRequestId}/reject-decisions from approvals-api.json.",
                'parameters' => [
                    "approval_request_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Approval request identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters approvals-api.json schema for Reject the approval request by id.",
                    ],
                ],
            ],
            "smartrecruiters_assessments_orders_get_list" => [
                'class' => SmartRecruitersAssessmentsOrdersGetList::class,
                'name' => "Retrieves all assessment orders for specified application",
                'description' => "Retrieves all assessment orders for specified application\n\nOfficial SmartRecruiters endpoint: GET /assessment-orders from assessments-api.json.",
                'parameters' => [
                    "application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the application",
                    ],
                ],
            ],
            "smartrecruiters_audit_audit_get" => [
                'class' => SmartRecruitersAuditAuditGet::class,
                'name' => "List audit events",
                'description' => "List audit events\n\nOfficial SmartRecruiters endpoint: GET /audit-events from audit-api.json.",
                'parameters' => [
                    "event_date_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the event time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ (example: 2023-01-21T12:50:02.594Z)",
                    ],
                    "event_date_before" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the event time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ (example: 2023-01-21T12:50:02.594Z)",
                    ],
                    "event_name" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "USER_ACCOUNT_ACTIVATED",
                                "USER_ACCOUNT_CREATED",
                                "USER_ACCOUNT_DEACTIVATED",
                                "USER_ACCOUNT_UPDATED",
                                "USER_AUTHENTICATION_INVALID_CREDENTIALS",
                                "USER_AUTHENTICATION_SUCCESS",
                                "USER_PASSWORD_CHANGED",
                                "USER_PASSWORD_RESET",
                                "USER_ROLE_CHANGED",
                                "USER_API_KEY_RENEWED",
                                "USER_LOGOUT",
                                "CREDENTIALS_CREATED",
                                "CREDENTIALS_CHANGED",
                                "CREDENTIALS_REVOKED",
                                "SEARCH",
                                "CANDIDATE_PERSONAL_DATA_MODIFIED",
                                "CANDIDATE_PROFILE_MODIFIED",
                                "CANDIDATE_DELETED",
                                "CANDIDATE_PROFILE_OPENED",
                                "CANDIDATE_PROFILE_UPDATED_DUE_TO_MERGE",
                                "CANDIDATE_DELETED_DUE_TO_MERGE",
                                "CANDIDATE_TAGS_MODIFIED",
                                "APPLICATION_PROPERTIES_UPDATED",
                                "APPLICATION_SOURCE_MODIFIED",
                                "ONBOARDING_STATUS_UPDATED",
                                "JOB_APPLICATION_CREATED",
                                "JOB_APPLICATION_STATE_MODIFIED",
                                "JOB_DELETED",
                                "HIRING_TEAM_MEMBER_ADDED",
                                "HIRING_TEAM_MEMBER_REMOVED",
                                "HIRING_TEAM_ROLE_UPDATED",
                                "APPROVAL_DELEGATION_FROM_USER_CREATED",
                                "APPROVAL_DELEGATION_FROM_USER_CANCELLED",
                                "APPROVAL_DELEGATION_TO_USER_CREATED",
                                "APPROVAL_DELEGATION_TO_USER_CANCELLED",
                                "JOB_APPROVAL_REQUESTED",
                                "JOB_APPROVAL_APPROVED",
                                "JOB_APPROVAL_REJECTED",
                                "JOB_APPROVAL_ABANDONED",
                                "JOB_APPROVAL_STEP_APPROVED",
                                "JOB_APPROVAL_STEP_REJECTED",
                                "JOB_APPROVAL_STEP_SKIPPED",
                                "JOB_APPROVAL_STEP_DELEGATED",
                                "OFFER_APPROVAL_APPROVED",
                                "OFFER_APPROVAL_REJECTED",
                                "OFFER_APPROVAL_ABANDONED",
                                "OFFER_APPROVAL_STEP_APPROVED",
                                "OFFER_APPROVAL_STEP_REJECTED",
                                "OFFER_APPROVAL_STEP_SKIPPED",
                                "OFFER_APPROVAL_STEP_DELEGATED",
                                "OFFER_ACCEPTED",
                                "OFFER_DECLINED",
                                "CANDIDATE_EEO_FILLED",
                                "LRSC_CONSENT_GIVEN",
                                "OAUTH_APPLICATION_ACCESS_GRANTED",
                                "JOB_PROPERTY_CREATED",
                                "JOB_PROPERTY_UPDATED",
                                "JOB_PROPERTY_ACTIVATED",
                                "JOB_PROPERTY_DEACTIVATED",
                                "JOB_PROPERTY_UPDATED_VALUES",
                                "JOB_PROPERTY_UPDATED_VALUE",
                                "JOB_PROPERTY_ADDED_VALUE",
                                "JOB_PROPERTY_ARCHIVED_VALUE",
                                "JOB_PROPERTY_DEPENDENT_PROPERTIES_UPDATED",
                                "JOB_PROPERTY_DEPENDENT_VALUES_UPDATED",
                                "JOB_PROPERTY_DEPENDENT_VALUES_MODIFIED",
                                "JOB_PROPERTIES_CHANGED",
                                "POSITION_UPDATED",
                                "POSITION_DELETED",
                                "POSITION_CREATED",
                                "POSITION_ASSIGNED",
                                "CANCEL_NOT_FILLED_POSITION",
                                "JOB_AD_CREATED",
                                "JOB_AD_UPDATED",
                                "JOB_AD_DELETED",
                                "ONBOARDING_PROCESS_DELETED",
                                "CUSTOMER_REPORT_DOWNLOADED",
                                "COMPANY_HIRING_TEAM_ROLE_CREATED",
                                "COMPANY_HIRING_TEAM_ROLE_UPDATED",
                                "COMPANY_HIRING_TEAM_ROLE_DELETED",
                                "COMPANY_HIRING_TEAM_ROLE_ACTIVATION_CHANGED",
                                "EMPLOYEE_FLAG_SET",
                                "EMPLOYEE_FLAG_REMOVED",
                                "EMPLOYEE_BADGE_ASSIGNED",
                                "EMPLOYEE_BADGE_REMOVED",
                                "WEB_SSO_CONFIGURATION_UPDATED",
                            ],
                        ],
                        "required" => false,
                        "description" => "Name of the event",
                    ],
                    "author_type" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "USER",
                                "SUPPORT_USER",
                                "SYSTEM",
                                "CANDIDATE",
                            ],
                        ],
                        "required" => false,
                        "description" => "Type of the author who generated the event",
                    ],
                    "author_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Unique identifier of the author",
                    ],
                    "entity_type" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "USER",
                                "CANDIDATE",
                                "APPLICATION",
                                "OFFER",
                                "JOB",
                                "COMPANY",
                                "JOB_PROPERTY",
                                "JOB_AD",
                                "CREDENTIAL",
                                "REPORT_FILE",
                                "ONBOARDING_PROCESS",
                                "HIRING_TEAM_ROLE",
                            ],
                        ],
                        "required" => false,
                        "description" => "Type of the entity that the event is related to",
                    ],
                    "entity_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Unique identifier of the entity that the event is related to",
                    ],
                    "next_page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Unique identifier for the next page of events",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Number of audit events to return. Maximum value is 100.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_access_group_create" => [
                'class' => SmartRecruitersConfigurationConfigurationAccessGroupCreate::class,
                'name' => "Create access group",
                'description' => "Create access group\n\nOfficial SmartRecruiters endpoint: POST /configuration/access-groups from configuration-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "## Access Group Request This request is used to **create/update an access group** by specifying its **name, description, and inclusion criteria**. ### Fields - **name (string, required)** The name of the access group. - **description (string, required)** A brief description of the access group. - **criteria (object, required)** Defines the conditions under which entities are included in the access group. - The **criteria** object **must contain exactly one include object**. - The **include** object contains multiple properties, where each property represents an active **job property** with category set to the **organization**. #### Each **job property** is referenced by its **ID** and includes the following attributes: - **all (boolean)** true Includes **all** values. false Includes **only** specified values. - **values (array)** A list of specific values to include (if all is set to false) or exclude (if all is set to true) ### Usage Examples - **Match all countries** all: true and an empty values array. - **Match specific countries** all: false and a list of country codes in values. - **Match all countries except certain ones** all: true with values specifying the excluded countries. To obtain a list of available **job properties** under the **organization** category, use the ****. The **job property ID** should be used as the key in the include object.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_access_group_list" => [
                'class' => SmartRecruitersConfigurationConfigurationAccessGroupList::class,
                'name' => "List access groups",
                'description' => "List access groups\n\nOfficial SmartRecruiters endpoint: GET /configuration/access-groups from configuration-api.json.",
                'parameters' => [
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "pageId",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "pageSize",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_access_group_get" => [
                'class' => SmartRecruitersConfigurationConfigurationAccessGroupGet::class,
                'name' => "Get access group",
                'description' => "Get access group\n\nOfficial SmartRecruiters endpoint: GET /configuration/access-groups/{accessGroupId} from configuration-api.json.",
                'parameters' => [
                    "access_group_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Access group identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_access_group_update" => [
                'class' => SmartRecruitersConfigurationConfigurationAccessGroupUpdate::class,
                'name' => "Update access group",
                'description' => "Update access group\n\nOfficial SmartRecruiters endpoint: PUT /configuration/access-groups/{accessGroupId} from configuration-api.json.",
                'parameters' => [
                    "access_group_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Access group identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "## Access Group Request This request is used to **create/update an access group** by specifying its **name, description, and inclusion criteria**. ### Fields - **name (string, required)** The name of the access group. - **description (string, required)** A brief description of the access group. - **criteria (object, required)** Defines the conditions under which entities are included in the access group. - The **criteria** object **must contain exactly one include object**. - The **include** object contains multiple properties, where each property represents an active **job property** with category set to the **organization**. #### Each **job property** is referenced by its **ID** and includes the following attributes: - **all (boolean)** true Includes **all** values. false Includes **only** specified values. - **values (array)** A list of specific values to include (if all is set to false) or exclude (if all is set to true) ### Usage Examples - **Match all countries** all: true and an empty values array. - **Match specific countries** all: false and a list of country codes in values. - **Match all countries except certain ones** all: true with values specifying the excluded countries. To obtain a list of available **job properties** under the **organization** category, use the ****. The **job property ID** should be used as the key in the include object.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_access_group_delete" => [
                'class' => SmartRecruitersConfigurationConfigurationAccessGroupDelete::class,
                'name' => "Delete access group",
                'description' => "Delete access group\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/access-groups/{accessGroupId} from configuration-api.json.",
                'parameters' => [
                    "access_group_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Access group identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_company_my" => [
                'class' => SmartRecruitersConfigurationConfigurationCompanyMy::class,
                'name' => "Get company information",
                'description' => "Get company information\n\nOfficial SmartRecruiters endpoint: GET /configuration/company from configuration-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_configuration_configuration_job_properties_all" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesAll::class,
                'name' => "Get a list of available job properties",
                'description' => "Get a list of available job properties\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties from configuration-api.json.",
                'parameters' => [
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "th",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_create" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesCreate::class,
                'name' => "Create a job property",
                'description' => "Create a job property\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties from configuration-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "job property to be created",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_get" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesGet::class,
                'name' => "Get job property by id",
                'description' => "Get job property by id\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "th",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_update" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesUpdate::class,
                'name' => "Update a job property",
                'description' => "Update a job property\n\nOfficial SmartRecruiters endpoint: PATCH /configuration/job-properties/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "patch request",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_translations_patch" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesTranslationsPatch::class,
                'name' => "Add a job property's translations",
                'description' => "Add a job property's translations\n\nOfficial SmartRecruiters endpoint: PATCH /configuration/job-properties/{id}/translations from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Add a job property's translations.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_get" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesGet::class,
                'name' => "Get available job property values",
                'description' => "Get available job property values\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties/{id}/values from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "th",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "pageId",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "pageSize",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_create" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesCreate::class,
                'name' => "Create a job property value",
                'description' => "Create a job property value\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties/{id}/values from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "job property object to be created",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_deprecated_archive" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesDeprecatedArchive::class,
                'name' => "Archive a job property value",
                'description' => "Archive a job property value\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_deprecated_unarchive" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesDeprecatedUnarchive::class,
                'name' => "Unarchive a job property value",
                'description' => "Unarchive a job property value\n\nOfficial SmartRecruiters endpoint: PUT /configuration/job-properties/{id}/values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_update" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesUpdate::class,
                'name' => "Update a job property value",
                'description' => "Update a job property value\n\nOfficial SmartRecruiters endpoint: PATCH /configuration/job-properties/{id}/values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "patch request",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_translations_patch" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesTranslationsPatch::class,
                'name' => "Add a job property value's translations",
                'description' => "Add a job property value's translations\n\nOfficial SmartRecruiters endpoint: PATCH /configuration/job-properties/{id}/values/{valueId}/translations from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Add a job property value's translations.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_archive" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesArchive::class,
                'name' => "Archive a job property value",
                'description' => "Archive a job property value\n\nOfficial SmartRecruiters endpoint: PUT /configuration/job-properties/{id}/archive-values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_values_unarchive" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesValuesUnarchive::class,
                'name' => "Unarchive a job property value",
                'description' => "Unarchive a job property value\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/archive-values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_activate" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesActivate::class,
                'name' => "Activate a job property",
                'description' => "Activate a job property\n\nOfficial SmartRecruiters endpoint: PUT /configuration/job-properties/{id}/activation from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_deactivate" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDeactivate::class,
                'name' => "Deactivate a job property",
                'description' => "Deactivate a job property\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/activation from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_dependents_all" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDependentsAll::class,
                'name' => "Get job property's dependents",
                'description' => "Get job property's dependents\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties/{id}/dependents from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "th",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_dependents_create" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDependentsCreate::class,
                'name' => "Create job property dependents",
                'description' => "Create job property dependents\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties/{id}/dependents from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Job properties' id",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_dependents_remove" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDependentsRemove::class,
                'name' => "Remove job property's dependent",
                'description' => "Remove job property's dependent\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/dependents/{dependentId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "dependent_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's dependent identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_dependents_values_all" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesAll::class,
                'name' => "Get dependent job property's values",
                'description' => "Get dependent job property's values\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties/{id}/dependents/{dependentId}/values from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "dependent_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's dependent identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "th",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_dependents_values_get" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesGet::class,
                'name' => "Get job property's dependent values",
                'description' => "Get job property's dependent values\n\nOfficial SmartRecruiters endpoint: GET /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                    "dependent_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's dependent identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "th",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "pageId",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "pageSize",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_dependents_values_add" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesAdd::class,
                'name' => "Add job property's dependent value",
                'description' => "Add job property's dependent value\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                    "dependent_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's dependent identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Identifier of job property's dependent value",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_job_properties_dependents_values_remove" => [
                'class' => SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesRemove::class,
                'name' => "Remove job property's dependent values relationship",
                'description' => "Remove job property's dependent values relationship\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values/{dependentValueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property identifier",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's value identifier",
                    ],
                    "dependent_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's dependent identifier",
                    ],
                    "dependent_value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job property's dependent value identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_department_create" => [
                'class' => SmartRecruitersConfigurationConfigurationDepartmentCreate::class,
                'name' => "Creates department",
                'description' => "Creates department\n\nOfficial SmartRecruiters endpoint: POST /configuration/departments from configuration-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "department to be created",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_department_all" => [
                'class' => SmartRecruitersConfigurationConfigurationDepartmentAll::class,
                'name' => "Get departments",
                'description' => "Get departments\n\nOfficial SmartRecruiters endpoint: GET /configuration/departments from configuration-api.json.",
                'parameters' => [
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "th",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_department_get" => [
                'class' => SmartRecruitersConfigurationConfigurationDepartmentGet::class,
                'name' => "Get department",
                'description' => "Get department\n\nOfficial SmartRecruiters endpoint: GET /configuration/departments/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a department",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_hiring_process_all" => [
                'class' => SmartRecruitersConfigurationConfigurationHiringProcessAll::class,
                'name' => "Get list of hiring process",
                'description' => "Get list of hiring process\n\nOfficial SmartRecruiters endpoint: GET /configuration/hiring-processes from configuration-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_configuration_configuration_hiring_process_get" => [
                'class' => SmartRecruitersConfigurationConfigurationHiringProcessGet::class,
                'name' => "Get hiring process",
                'description' => "Get hiring process\n\nOfficial SmartRecruiters endpoint: GET /configuration/hiring-processes/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a hiring process",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_offer_properties_all" => [
                'class' => SmartRecruitersConfigurationConfigurationOfferPropertiesAll::class,
                'name' => "Get a list of available offer properties",
                'description' => "Get a list of available offer properties\n\nOfficial SmartRecruiters endpoint: GET /configuration/offer-properties from configuration-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_configuration_configuration_candidate_properties_all" => [
                'class' => SmartRecruitersConfigurationConfigurationCandidatePropertiesAll::class,
                'name' => "Get a list of available candidate properties",
                'description' => "Get a list of available candidate properties\n\nOfficial SmartRecruiters endpoint: GET /configuration/candidate-properties from configuration-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_configuration_configuration_candidate_properties_get" => [
                'class' => SmartRecruitersConfigurationConfigurationCandidatePropertiesGet::class,
                'name' => "Get candidate property by id",
                'description' => "Get candidate property by id\n\nOfficial SmartRecruiters endpoint: GET /configuration/candidate-properties/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_candidate_properties_values_all" => [
                'class' => SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesAll::class,
                'name' => "Get Candidate Property values",
                'description' => "Get Candidate Property values\n\nOfficial SmartRecruiters endpoint: GET /configuration/candidate-properties/{id}/values from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_candidate_properties_values_create" => [
                'class' => SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesCreate::class,
                'name' => "Create candidate property value",
                'description' => "Create candidate property value\n\nOfficial SmartRecruiters endpoint: POST /configuration/candidate-properties/{id}/values from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Candidate property value.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_candidate_properties_values_get" => [
                'class' => SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesGet::class,
                'name' => "Get Candidate Property value by id",
                'description' => "Get Candidate Property value by id\n\nOfficial SmartRecruiters endpoint: GET /configuration/candidate-properties/{id}/values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate property's value identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_candidate_properties_values_update" => [
                'class' => SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesUpdate::class,
                'name' => "Update candidate property value label",
                'description' => "Update candidate property value label\n\nOfficial SmartRecruiters endpoint: PUT /configuration/candidate-properties/{id}/values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate property's value identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Candidate property value label.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_candidate_properties_values_delete" => [
                'class' => SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesDelete::class,
                'name' => "Remove candidate property value",
                'description' => "Remove candidate property value\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/candidate-properties/{id}/values/{valueId} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                    "value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate property's value identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_source_types" => [
                'class' => SmartRecruitersConfigurationConfigurationSourceTypes::class,
                'name' => "List candidate source types with subtypes",
                'description' => "List candidate source types with subtypes\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources from configuration-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_configuration_configuration_source_values_all" => [
                'class' => SmartRecruitersConfigurationConfigurationSourceValuesAll::class,
                'name' => "List candidate sources",
                'description' => "List candidate sources\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources/{sourceType}/values from configuration-api.json.",
                'parameters' => [
                    "source_type" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Source type from /configuration/sources",
                    ],
                    "source_sub_type" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Source SubType from /configuration/sources",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return. max value is 100",
                    ],
                    "offset" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to skip while processing result",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_source_values_single" => [
                'class' => SmartRecruitersConfigurationConfigurationSourceValuesSingle::class,
                'name' => "Get a candidate source",
                'description' => "Get a candidate source\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources/{sourceType}/values/{sourceValueId} from configuration-api.json.",
                'parameters' => [
                    "source_type" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Source type from /configuration/sources",
                    ],
                    "source_value_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Source id",
                    ],
                    "source_sub_type" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Source SubType from /configuration/sources",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_source_values_single_by_identifier" => [
                'class' => SmartRecruitersConfigurationConfigurationSourceValuesSingleByIdentifier::class,
                'name' => "Get a candidate source by identifier.",
                'description' => "Get a candidate source by identifier.\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources/{sourceIdentifier} from configuration-api.json.",
                'parameters' => [
                    "source_identifier" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Source identifier",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_source_values_recruiter_source_by_name" => [
                'class' => SmartRecruitersConfigurationConfigurationSourceValuesRecruiterSourceByName::class,
                'name' => "Get recruiter source by name",
                'description' => "Get recruiter source by name\n\nOfficial SmartRecruiters endpoint: PUT /configuration/sources/recruiters/resolve from configuration-api.json.",
                'parameters' => [
                    "source_name" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Name of the source",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_reasons_rejection_all" => [
                'class' => SmartRecruitersConfigurationConfigurationReasonsRejectionAll::class,
                'name' => "Get rejection reasons",
                'description' => "Get rejection reasons\n\nOfficial SmartRecruiters endpoint: GET /configuration/rejection-reasons from configuration-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_configuration_configuration_reasons_withdrawal_all" => [
                'class' => SmartRecruitersConfigurationConfigurationReasonsWithdrawalAll::class,
                'name' => "Get withdrawal reasons",
                'description' => "Get withdrawal reasons\n\nOfficial SmartRecruiters endpoint: GET /configuration/withdrawal-reasons from configuration-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_configuration_configuration_careersites_list" => [
                'class' => SmartRecruitersConfigurationConfigurationCareersitesList::class,
                'name' => "List career sites configurations",
                'description' => "List career sites configurations\n\nOfficial SmartRecruiters endpoint: GET /configuration/career-sites from configuration-api.json.",
                'parameters' => [
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "pageId",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "pageSize",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_careersites_get" => [
                'class' => SmartRecruitersConfigurationConfigurationCareersitesGet::class,
                'name' => "Get details of career site configuration",
                'description' => "Get details of career site configuration\n\nOfficial SmartRecruiters endpoint: GET /configuration/career-sites/{careerSiteId} from configuration-api.json.",
                'parameters' => [
                    "career_site_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Id of a career site configuration",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_predefined_locations_get_many" => [
                'class' => SmartRecruitersConfigurationConfigurationPredefinedLocationsGetMany::class,
                'name' => "Get list of predefined locations",
                'description' => "Get list of predefined locations\n\nOfficial SmartRecruiters endpoint: GET /configuration/predefined-locations from configuration-api.json.",
                'parameters' => [
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "pageId",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "pageSize",
                    ],
                    "identifiers" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "Comma-separated list of identifiers to filter by",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_predefined_locations_create_one" => [
                'class' => SmartRecruitersConfigurationConfigurationPredefinedLocationsCreateOne::class,
                'name' => "Create predefined location",
                'description' => "Create predefined location\n\nOfficial SmartRecruiters endpoint: POST /configuration/predefined-locations from configuration-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Create predefined location.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_predefined_locations_delete_many" => [
                'class' => SmartRecruitersConfigurationConfigurationPredefinedLocationsDeleteMany::class,
                'name' => "Remove multiple predefined locations",
                'description' => "Remove multiple predefined locations\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/predefined-locations from configuration-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Remove multiple predefined locations.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_predefined_locations_get_one" => [
                'class' => SmartRecruitersConfigurationConfigurationPredefinedLocationsGetOne::class,
                'name' => "Get predefined location by id",
                'description' => "Get predefined location by id\n\nOfficial SmartRecruiters endpoint: GET /configuration/predefined-locations/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_predefined_locations_update_one" => [
                'class' => SmartRecruitersConfigurationConfigurationPredefinedLocationsUpdateOne::class,
                'name' => "Update predefined location",
                'description' => "Update predefined location\n\nOfficial SmartRecruiters endpoint: PUT /configuration/predefined-locations/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Update predefined location.",
                    ],
                ],
            ],
            "smartrecruiters_configuration_configuration_predefined_locations_delete_one" => [
                'class' => SmartRecruitersConfigurationConfigurationPredefinedLocationsDeleteOne::class,
                'name' => "Remove predefined location",
                'description' => "Remove predefined location\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/predefined-locations/{id} from configuration-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                ],
            ],
            "smartrecruiters_interviews_types_get" => [
                'class' => SmartRecruitersInterviewsTypesGet::class,
                'name' => "Retrieves interview types",
                'description' => "Retrieves interview types\n\nOfficial SmartRecruiters endpoint: GET /interview-types from interviews.json.",
                'parameters' => [],
            ],
            "smartrecruiters_interviews_types_update" => [
                'class' => SmartRecruitersInterviewsTypesUpdate::class,
                'name' => "Adds interview types to already existing ones",
                'description' => "Adds interview types to already existing ones\n\nOfficial SmartRecruiters endpoint: PATCH /interview-types from interviews.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Interview types to be added",
                    ],
                ],
            ],
            "smartrecruiters_interviews_types_delete" => [
                'class' => SmartRecruitersInterviewsTypesDelete::class,
                'name' => "Removes interview type with given name",
                'description' => "Removes interview type with given name\n\nOfficial SmartRecruiters endpoint: DELETE /interview-types/{interviewType} from interviews.json.",
                'parameters' => [
                    "interview_type" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Interview type name",
                    ],
                ],
            ],
            "smartrecruiters_interviews_interviews_get_list" => [
                'class' => SmartRecruitersInterviewsInterviewsGetList::class,
                'name' => "Retrieves a list of interviews",
                'description' => "Retrieves a list of interviews\n\nOfficial SmartRecruiters endpoint: GET /interviews from interviews.json.",
                'parameters' => [
                    "application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the application",
                    ],
                ],
            ],
            "smartrecruiters_interviews_interviews_create" => [
                'class' => SmartRecruitersInterviewsInterviewsCreate::class,
                'name' => "Creates an interview",
                'description' => "Creates an interview\n\nOfficial SmartRecruiters endpoint: POST /interviews from interviews.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Interview to be added",
                    ],
                ],
            ],
            "smartrecruiters_interviews_interviews_get" => [
                'class' => SmartRecruitersInterviewsInterviewsGet::class,
                'name' => "Retrieves an interview",
                'description' => "Retrieves an interview\n\nOfficial SmartRecruiters endpoint: GET /interviews/{interviewId} from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                ],
            ],
            "smartrecruiters_interviews_interviews_update" => [
                'class' => SmartRecruitersInterviewsInterviewsUpdate::class,
                'name' => "Modifies an interview",
                'description' => "Modifies an interview\n\nOfficial SmartRecruiters endpoint: PATCH /interviews/{interviewId} from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Interview to be updated",
                    ],
                ],
            ],
            "smartrecruiters_interviews_interviews_delete" => [
                'class' => SmartRecruitersInterviewsInterviewsDelete::class,
                'name' => "Deletes an interview",
                'description' => "Deletes an interview\n\nOfficial SmartRecruiters endpoint: DELETE /interviews/{interviewId} from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                ],
            ],
            "smartrecruiters_interviews_timeslots_create" => [
                'class' => SmartRecruitersInterviewsTimeslotsCreate::class,
                'name' => "Creates a timeslot",
                'description' => "Creates a timeslot\n\nOfficial SmartRecruiters endpoint: POST /interviews/{interviewId}/timeslots from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Timeslot to be added",
                    ],
                ],
            ],
            "smartrecruiters_interviews_timeslots_get" => [
                'class' => SmartRecruitersInterviewsTimeslotsGet::class,
                'name' => "Retrieves a timeslot",
                'description' => "Retrieves a timeslot\n\nOfficial SmartRecruiters endpoint: GET /interviews/{interviewId}/timeslots/{timeslotId} from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "timeslot_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the timeslot",
                    ],
                ],
            ],
            "smartrecruiters_interviews_timeslots_update" => [
                'class' => SmartRecruitersInterviewsTimeslotsUpdate::class,
                'name' => "Modifies a timeslot",
                'description' => "Modifies a timeslot\n\nOfficial SmartRecruiters endpoint: PATCH /interviews/{interviewId}/timeslots/{timeslotId} from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "timeslot_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the timeslot",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Timeslot to be updated",
                    ],
                ],
            ],
            "smartrecruiters_interviews_timeslots_delete" => [
                'class' => SmartRecruitersInterviewsTimeslotsDelete::class,
                'name' => "Deletes a timeslot",
                'description' => "Deletes a timeslot\n\nOfficial SmartRecruiters endpoint: DELETE /interviews/{interviewId}/timeslots/{timeslotId} from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "timeslot_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the timeslot",
                    ],
                ],
            ],
            "smartrecruiters_interviews_statuses_candidate_put" => [
                'class' => SmartRecruitersInterviewsStatusesCandidatePut::class,
                'name' => "Changes a candidate's status.",
                'description' => "Changes a candidate's status.\n\nOfficial SmartRecruiters endpoint: PUT /interviews/{interviewId}/candidate/status from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "New candidate's status",
                    ],
                ],
            ],
            "smartrecruiters_interviews_statuses_interviewer_put" => [
                'class' => SmartRecruitersInterviewsStatusesInterviewerPut::class,
                'name' => "Changes a interviewer's status in given timeslot",
                'description' => "Changes a interviewer's status in given timeslot\n\nOfficial SmartRecruiters endpoint: PUT /interviews/{interviewId}/timeslots/{timeslotId}/interviewers/{userId}/status from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "timeslot_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the timeslot",
                    ],
                    "user_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the user",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "New interviewer's status",
                    ],
                ],
            ],
            "smartrecruiters_interviews_timeslots_patch_noshow" => [
                'class' => SmartRecruitersInterviewsTimeslotsPatchNoshow::class,
                'name' => "Changes no-show value in a timeslot",
                'description' => "Changes no-show value in a timeslot\n\nOfficial SmartRecruiters endpoint: PATCH /interviews/{interviewId}/timeslots/{timeslotId}/noshow from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "timeslot_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the timeslot",
                    ],
                    "value" => [
                        "type" => "boolean",
                        "required" => true,
                        "description" => "New no-show value",
                    ],
                ],
            ],
            "smartrecruiters_interviews_statuses_timeslot_candidate_put" => [
                'class' => SmartRecruitersInterviewsStatusesTimeslotCandidatePut::class,
                'name' => "Changes a candidate's status in given timeslot",
                'description' => "Changes a candidate's status in given timeslot\n\nOfficial SmartRecruiters endpoint: PUT /interviews/{interviewId}/timeslots/{timeslotId}/candidateStatus from interviews.json.",
                'parameters' => [
                    "interview_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the interview",
                    ],
                    "timeslot_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the timeslot",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "New candidate's status",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_positions_all" => [
                'class' => SmartRecruitersJobsJobsPositionsAll::class,
                'name' => "Positions for a job",
                'description' => "Positions for a job\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/positions from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_positions_create" => [
                'class' => SmartRecruitersJobsJobsPositionsCreate::class,
                'name' => "Create a new position for a job",
                'description' => "Create a new position for a job\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/positions from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Position body object",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_positions_get" => [
                'class' => SmartRecruitersJobsJobsPositionsGet::class,
                'name' => "Get a single position",
                'description' => "Get a single position\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/positions/{positionId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "position_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "position identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_positions_update" => [
                'class' => SmartRecruitersJobsJobsPositionsUpdate::class,
                'name' => "Update position",
                'description' => "Update position\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId}/positions/{positionId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "position_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "position identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Position body object",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_positions_remove" => [
                'class' => SmartRecruitersJobsJobsPositionsRemove::class,
                'name' => "Delete position",
                'description' => "Delete position\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/positions/{positionId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "position_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "position identifier",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_jobads_all" => [
                'class' => SmartRecruitersJobsJobsJobadsAll::class,
                'name' => "Find and list job ads for a given job",
                'description' => "Find and list job ads for a given job\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/jobads from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_jobads_create" => [
                'class' => SmartRecruitersJobsJobsJobadsCreate::class,
                'name' => "Create a new job ad",
                'description' => "Create a new job ad\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/jobads from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "job ad",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_jobads_get" => [
                'class' => SmartRecruitersJobsJobsJobadsGet::class,
                'name' => "Get a job ad",
                'description' => "Get a job ad\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/jobads/{jobAdId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "job_ad_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job ad identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_jobads_update" => [
                'class' => SmartRecruitersJobsJobsJobadsUpdate::class,
                'name' => "Update a job ad",
                'description' => "Update a job ad\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId}/jobads/{jobAdId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "job_ad_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job ad identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "job ad",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_jobads_postings_create" => [
                'class' => SmartRecruitersJobsJobsJobadsPostingsCreate::class,
                'name' => "Publishes a job ad",
                'description' => "Publishes a job ad\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/jobads/{jobAdId}/postings from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "job_ad_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job ad identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Publication object",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_jobads_postings_all" => [
                'class' => SmartRecruitersJobsJobsJobadsPostingsAll::class,
                'name' => "List publications for a job ad",
                'description' => "List publications for a job ad\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/jobads/{jobAdId}/postings from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "job_ad_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job ad identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                    "active_only" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "publication status filter; when omitted, defaults to 'true' (only active publications are returned); 'false' returns active and inactive publications",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_jobads_postings_unpublish" => [
                'class' => SmartRecruitersJobsJobsJobadsPostingsUnpublish::class,
                'name' => "Unpublish a job ad",
                'description' => "Unpublish a job ad\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/jobads/{jobAdId}/postings from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "job_ad_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job ad identifier",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_publication_create" => [
                'class' => SmartRecruitersJobsJobsPublicationCreate::class,
                'name' => "Publishes a default job ad",
                'description' => "Publishes a default job ad\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/publication from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Publication object",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_publication_unpublish" => [
                'class' => SmartRecruitersJobsJobsPublicationUnpublish::class,
                'name' => "Unpublishes a job from all sources",
                'description' => "Unpublishes a job from all sources\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/publication from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_publication_all" => [
                'class' => SmartRecruitersJobsJobsPublicationAll::class,
                'name' => "Find and list publications for a job",
                'description' => "Find and list publications for a job\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/publication from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                    "active_only" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "publication status filter; defaults to 'true' (only active publications are returned); 'false' returns active and inactive publications",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_hiring_team_get" => [
                'class' => SmartRecruitersJobsJobsHiringTeamGet::class,
                'name' => "Get hiring team of a job with a given id.",
                'description' => "Get hiring team of a job with a given id.\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/hiring-team from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_hiring_team_add" => [
                'class' => SmartRecruitersJobsJobsHiringTeamAdd::class,
                'name' => "Add hiring team member of a job with a given id.",
                'description' => "Add hiring team member of a job with a given id.\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/hiring-team from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "HiringTeamMember object",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_hiring_team_remove" => [
                'class' => SmartRecruitersJobsJobsHiringTeamRemove::class,
                'name' => "Removes hiring team member of a job with a given id.",
                'description' => "Removes hiring team member of a job with a given id.\n\nOfficial SmartRecruiters endpoint: DELETE /jobs/{jobId}/hiring-team/{userId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "user_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_notes_get" => [
                'class' => SmartRecruitersJobsJobsNotesGet::class,
                'name' => "Get note of a job.",
                'description' => "Get note of a job.\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/note from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_notes_update" => [
                'class' => SmartRecruitersJobsJobsNotesUpdate::class,
                'name' => "Update note of a job.",
                'description' => "Update note of a job.\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId}/note from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters jobs-api.json schema for Update note of a job..",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_headcount_update" => [
                'class' => SmartRecruitersJobsJobsHeadcountUpdate::class,
                'name' => "Update job headcount.",
                'description' => "Update job headcount.\n\nOfficial SmartRecruiters endpoint: PATCH /jobs/{jobId}/headcount from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters jobs-api.json schema for Update job headcount..",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_all" => [
                'class' => SmartRecruitersJobsJobsAll::class,
                'name' => "Search jobs",
                'description' => "Search jobs\n\nOfficial SmartRecruiters endpoint: GET /jobs from jobs-api.json.",
                'parameters' => [
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                    "q" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "full-text search query based on a job title; case insensitive; e.g. java developer",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return. max value is 100",
                    ],
                    "offset" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to skip while processing result; this method of paging is very slow and is deprecated, please use pageId instead",
                    ],
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "unique identifier for next page of jobs - returned as nextPageId in previous page result. You must set job_id value for sort parameter if you use pageId.",
                    ],
                    "sort" => [
                        "type" => "string",
                        "enum" => [
                            "default",
                            "job_id",
                        ],
                        "required" => false,
                        "description" => "Order in which results are returned. - default - sorts results by creation date or by match score and creation date if query (q) is set. Can't be used with pageId parameter (request might not return all results) - job_id - sorts results by job id. The only supported sorting order when using pageId based pagination.",
                    ],
                    "city" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "city filter (part of the location object); can be used repeatedly; case sensitive; e.g. San Francisco",
                    ],
                    "department" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "department filter (by department label); can be used repeatedly; case sensitive; e.g. Marketing",
                    ],
                    "updated_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the job update time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                    "last_activity_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the job lastActivityOn time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ. lastActivityOn is updated when job is edited, new candidates apply or job is published.",
                    ],
                    "language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "Exceptions to the language code ISO format: * \"en-GB\" - \"English - English (UK)\" * \"es-MX\" - \"Spanish - espaol (Mxico)\" * \"fr-CA\" - \"French - franais (Canada)\" * \"pt-BR\" - \"Portugal - portugus (Brasil)\" * \"zh-TW\" - \"Chinese (Traditional) - ()\" * \"zh-CN\" - \"Chinese (Simplified) - ()\" Value \"pt-PT\" is deprecated and will not work, use \"pt\" instead.",
                    ],
                    "status" => [
                        "type" => "string",
                        "enum" => [
                            "CREATED",
                            "SOURCING",
                            "FILLED",
                            "INTERVIEW",
                            "OFFER",
                            "CANCELLED",
                            "ON_HOLD",
                        ],
                        "required" => false,
                        "description" => "Status of a job. Deprecated - cannot be used repeatedly. To filter by multiple status, use \"statuses\".",
                    ],
                    "statuses" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "CREATED",
                                "SOURCING",
                                "FILLED",
                                "INTERVIEW",
                                "OFFER",
                                "CANCELLED",
                                "ON_HOLD",
                            ],
                        ],
                        "required" => false,
                        "description" => "Job status filter, can be used repeatedly. When present, overrides \"status\".",
                    ],
                    "posting_status" => [
                        "type" => "string",
                        "enum" => [
                            "PUBLIC",
                            "INTERNAL",
                            "NOT_PUBLISHED",
                            "PRIVATE",
                        ],
                        "required" => false,
                        "description" => "Posting status of a job",
                    ],
                    "hiring_team_member_id" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "Filter jobs to those where any of the given users is a member of the job's hiring team. Values are user identifiers.",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_create" => [
                'class' => SmartRecruitersJobsJobsCreate::class,
                'name' => "Create a new job",
                'description' => "Create a new job\n\nOfficial SmartRecruiters endpoint: POST /jobs from jobs-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Job object that needs to be created",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_get" => [
                'class' => SmartRecruitersJobsJobsGet::class,
                'name' => "Get content of a job with a given id.",
                'description' => "Get content of a job with a given id.\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_patch" => [
                'class' => SmartRecruitersJobsJobsPatch::class,
                'name' => "Update a job",
                'description' => "Update a job\n\nOfficial SmartRecruiters endpoint: PATCH /jobs/{jobId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters jobs-api.json schema for Update a job.",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_update" => [
                'class' => SmartRecruitersJobsJobsUpdate::class,
                'name' => "Updates job",
                'description' => "Updates job\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId} from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Job that needs to be updated",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_status_update" => [
                'class' => SmartRecruitersJobsJobsStatusUpdate::class,
                'name' => "Updates job status",
                'description' => "Updates job status\n\nOfficial SmartRecruiters endpoint: PUT /jobs/{jobId}/status from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters jobs-api.json schema for Updates job status.",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_status_history_get" => [
                'class' => SmartRecruitersJobsJobsStatusHistoryGet::class,
                'name' => "Job status history",
                'description' => "Job status history\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/status/history from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_jobs_jobs_approvals_latest" => [
                'class' => SmartRecruitersJobsJobsApprovalsLatest::class,
                'name' => "Get latest approval request for given job",
                'description' => "Get latest approval request for given job\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/approvals/latest from jobs-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "hy",
                            "az",
                            "eu",
                            "bn",
                            "bg",
                            "ca",
                            "zh-CN",
                            "zh-TW",
                            "hr",
                            "cs",
                            "da",
                            "nl",
                            "en-GB",
                            "en",
                            "et",
                            "fi",
                            "fr",
                            "fr-CA",
                            "gl",
                            "ka",
                            "de",
                            "el",
                            "gu",
                            "iw",
                            "hi",
                            "hu",
                            "is",
                            "id",
                            "ga",
                            "it",
                            "ja",
                            "kn",
                            "km",
                            "ko",
                            "lo",
                            "lv",
                            "lt",
                            "ms",
                            "ml",
                            "mr",
                            "mn",
                            "ne",
                            "no",
                            "fa",
                            "fil",
                            "pl",
                            "pt",
                            "pt-BR",
                            "pt-PT",
                            "ro",
                            "ru",
                            "sr",
                            "si",
                            "sk",
                            "sl",
                            "es",
                            "es-MX",
                            "sw",
                            "sv",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "cy",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "language of returned content",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_tags_add" => [
                'class' => SmartRecruitersCandidatesCandidatesTagsAdd::class,
                'name' => "Add tags to a candidate",
                'description' => "Add tags to a candidate\n\nOfficial SmartRecruiters endpoint: POST /candidates/{id}/tags from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Tags to be added.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_tags_get" => [
                'class' => SmartRecruitersCandidatesCandidatesTagsGet::class,
                'name' => "Get tags for a candidate",
                'description' => "Get tags for a candidate\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/tags from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_tags_replace" => [
                'class' => SmartRecruitersCandidatesCandidatesTagsReplace::class,
                'name' => "Update tags for a candidate",
                'description' => "Update tags for a candidate\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/tags from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Tags to be set.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_tags_delete" => [
                'class' => SmartRecruitersCandidatesCandidatesTagsDelete::class,
                'name' => "Delete tags for a candidate",
                'description' => "Delete tags for a candidate\n\nOfficial SmartRecruiters endpoint: DELETE /candidates/{id}/tags from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_onboarding_get" => [
                'class' => SmartRecruitersCandidatesCandidatesOnboardingGet::class,
                'name' => "Get Onboarding Status for a candidate",
                'description' => "Get Onboarding Status for a candidate\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/onboardingStatus from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_onboarding_update" => [
                'class' => SmartRecruitersCandidatesCandidatesOnboardingUpdate::class,
                'name' => "Set Onboarding Status for a candidate",
                'description' => "Set Onboarding Status for a candidate\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/onboardingStatus from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Onboarding status.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_onboarding_get_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesOnboardingGetForJob::class,
                'name' => "Get Onboarding Status for a candidate associated with given job",
                'description' => "Get Onboarding Status for a candidate associated with given job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/onboardingStatus from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_onboarding_update_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesOnboardingUpdateForJob::class,
                'name' => "Sets Onboarding Status for a candidate associated with given job",
                'description' => "Sets Onboarding Status for a candidate associated with given job\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/onboardingStatus from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Onboarding status.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_all" => [
                'class' => SmartRecruitersCandidatesCandidatesAll::class,
                'name' => "Search candidates",
                'description' => "Search candidates\n\nOfficial SmartRecruiters endpoint: GET /candidates from candidates-api.json.",
                'parameters' => [
                    "q" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "keyword search, for more information see",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return. max value is 100",
                    ],
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "page identifier of elements to return The pageId param can be used to fetch multiple page response, in case the number of results is higher than max number of elements to return (specified in the limit parameter). The pageId should not be present when requesting the first page of results. The pageId of the following page is returned either in the nextPageId property, or is available in the HTTP header Link value of relation type next. Example of the Link header: ; rel=\"next\"",
                    ],
                    "job_id" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "job filter to display candidates who applied for a job [id]; can be used repeatedly;",
                    ],
                    "location" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "location keyword search which looks up a string in a candidates location data; can be used repeatedly; case insensitive; e.g. Krakow",
                    ],
                    "average_rating" => [
                        "type" => "array",
                        "items" => [
                            "type" => "integer",
                        ],
                        "required" => false,
                        "description" => "average rating filter to display candidates with a specific average rating (integer); can be used repeatedly; e.g. 4",
                    ],
                    "status" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "LEAD",
                                "NEW",
                                "IN_REVIEW",
                                "INTERVIEW",
                                "OFFERED",
                                "HIRED",
                                "REJECTED",
                                "WITHDRAWN",
                                "TRANSFERRED",
                            ],
                        ],
                        "required" => false,
                        "description" => "candidates status filter in a context of a job; can be used repeatedly",
                    ],
                    "consent_status" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "REQUIRED",
                                "PENDING",
                                "ACQUIRED",
                            ],
                        ],
                        "required" => false,
                        "description" => "candidates consent status filter; can be used repeatedly",
                    ],
                    "sub_status" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "candidates sub-status filter in a context of a job. Works only in a correlation with a set value for the \"status\" field.",
                    ],
                    "tag" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "tag assigned to a candidate; can be used repeatedly; case insensitive; e.g. fluent english",
                    ],
                    "updated_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the candidate update time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                    "onboarding_status" => [
                        "type" => "string",
                        "enum" => [
                            "READY_TO_ONBOARD",
                            "ONBOARDING_SUCCESSFUL",
                            "ONBOARDING_FAILED",
                        ],
                        "required" => false,
                        "description" => "candidate's onboarding status",
                    ],
                    "property_id" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "candidate's property id (1-N). Currently it is only possible to filter by single-select application fields. Other application field type filtering is not possible.",
                    ],
                    "property_value_id" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "candidate's property value id (1-N)",
                    ],
                    "source_type" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "candidate's source type (1-N)",
                    ],
                    "source_sub_type" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "candidate's source subtype (1-N)",
                    ],
                    "source_value_id" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "candidate's source value id (1-N)",
                    ],
                    "question_category" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "screening question category (1-N)",
                    ],
                    "question_field_id" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "screening question field id (1-N)",
                    ],
                    "question_field_value_id" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                        ],
                        "required" => false,
                        "description" => "screening question field value id (1-N)",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_add" => [
                'class' => SmartRecruitersCandidatesCandidatesAdd::class,
                'name' => "Create a new candidate and assign to a Talent Pool",
                'description' => "Create a new candidate and assign to a Talent Pool\n\nOfficial SmartRecruiters endpoint: POST /candidates from candidates-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Candidate object that needs to be created.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_resume_add" => [
                'class' => SmartRecruitersCandidatesCandidatesResumeAdd::class,
                'name' => "Parse a resume, create a candidate and assign to a Talent Pool.",
                'description' => "Parse a resume, create a candidate and assign to a Talent Pool.\n\nOfficial SmartRecruiters endpoint: POST /candidates/cv from candidates-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Parse a resume, create a candidate and assign to a Talent Pool..",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_resume_parse" => [
                'class' => SmartRecruitersCandidatesCandidatesResumeParse::class,
                'name' => "Parse a resume",
                'description' => "Parse a resume\n\nOfficial SmartRecruiters endpoint: POST /candidates/cv/parse from candidates-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Parse a resume.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_consent_request_batch" => [
                'class' => SmartRecruitersCandidatesCandidatesConsentRequestBatch::class,
                'name' => "Request consent from multiple candidates",
                'description' => "Request consent from multiple candidates\n\nOfficial SmartRecruiters endpoint: POST /candidates/consent-requests from candidates-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Request consent from multiple candidates.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_consent_status" => [
                'class' => SmartRecruitersCandidatesCandidatesConsentStatus::class,
                'name' => "Status of candidate consent",
                'description' => "Status of candidate consent\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/consent from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_consent_decisions" => [
                'class' => SmartRecruitersCandidatesCandidatesConsentDecisions::class,
                'name' => "Candidate consent decisions",
                'description' => "Candidate consent decisions\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/consents from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_get" => [
                'class' => SmartRecruitersCandidatesCandidatesGet::class,
                'name' => "Get details of a candidate",
                'description' => "Get details of a candidate\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_delete" => [
                'class' => SmartRecruitersCandidatesCandidatesDelete::class,
                'name' => "Delete Candidate",
                'description' => "Delete Candidate\n\nOfficial SmartRecruiters endpoint: DELETE /candidates/{id} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_update" => [
                'class' => SmartRecruitersCandidatesCandidatesUpdate::class,
                'name' => "Update candidate personal information",
                'description' => "Update candidate personal information\n\nOfficial SmartRecruiters endpoint: PATCH /candidates/{id} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Candidate personal information",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_attachments_list" => [
                'class' => SmartRecruitersCandidatesCandidatesAttachmentsList::class,
                'name' => "Get list candidate's attachments.",
                'description' => "Get list candidate's attachments.\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/attachments from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_attachments_add" => [
                'class' => SmartRecruitersCandidatesCandidatesAttachmentsAdd::class,
                'name' => "Attach files to a candidate.",
                'description' => "Attach files to a candidate.\n\nOfficial SmartRecruiters endpoint: POST /candidates/{id}/attachments from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Attach files to a candidate..",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_attachments_get" => [
                'class' => SmartRecruitersCandidatesCandidatesAttachmentsGet::class,
                'name' => "Get a candidate's attachment.",
                'description' => "Get a candidate's attachment.\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/attachments/{attachmentId} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "attachment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of an attachment",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_attachments_list_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesAttachmentsListForJob::class,
                'name' => "Get list of candidate's attachments in context of given job.",
                'description' => "Get list of candidate's attachments in context of given job.\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/attachments from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_attachments_add_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesAttachmentsAddForJob::class,
                'name' => "Attach file to candidate in context of given job.",
                'description' => "Attach file to candidate in context of given job.\n\nOfficial SmartRecruiters endpoint: POST /candidates/{id}/jobs/{jobId}/attachments from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Attach file to candidate in context of given job..",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_attachments_get_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesAttachmentsGetForJob::class,
                'name' => "Get candidate's attachment.",
                'description' => "Get candidate's attachment.\n\nOfficial SmartRecruiters endpoint: GET /candidates/attachments/{attachmentId} from candidates-api.json.",
                'parameters' => [
                    "attachment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "attachment identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_attachments_delete_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesAttachmentsDeleteForJob::class,
                'name' => "Delete attachment.",
                'description' => "Delete attachment.\n\nOfficial SmartRecruiters endpoint: DELETE /candidates/attachments/{attachmentId} from candidates-api.json.",
                'parameters' => [
                    "attachment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "attachment identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_status_update" => [
                'class' => SmartRecruitersCandidatesCandidatesStatusUpdate::class,
                'name' => "Update a candidate's status",
                'description' => "Update a candidate's status\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/status from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Candidate Status to be set",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_status_update_primary" => [
                'class' => SmartRecruitersCandidatesCandidatesStatusUpdatePrimary::class,
                'name' => "Update a candidate's status on primary assignment",
                'description' => "Update a candidate's status on primary assignment\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/status from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Candidate Status to be set",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_status_history_get" => [
                'class' => SmartRecruitersCandidatesCandidatesStatusHistoryGet::class,
                'name' => "Get candidate's status history",
                'description' => "Get candidate's status history\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/status/history from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_status_history_get_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesStatusHistoryGetForJob::class,
                'name' => "Get candidate's status history for a candidate's job",
                'description' => "Get candidate's status history for a candidate's job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/status/history from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_source_update" => [
                'class' => SmartRecruitersCandidatesCandidatesSourceUpdate::class,
                'name' => "Update a candidate's source",
                'description' => "Update a candidate's source\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/source from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Candidate source to be set",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_properties_get" => [
                'class' => SmartRecruitersCandidatesCandidatesPropertiesGet::class,
                'name' => "Get candidate property values for a candidate",
                'description' => "Get candidate property values for a candidate\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/properties from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "context" => [
                        "type" => "string",
                        "enum" => [
                            "PROFILE",
                            "OFFER_FORM",
                            "HIRE_FORM",
                            "OFFER_APPROVAL_FORM",
                        ],
                        "required" => false,
                        "description" => "context for candidate properties to display",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_properties_get_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesPropertiesGetForJob::class,
                'name' => "Get candidate property values for a candidate's job",
                'description' => "Get candidate property values for a candidate's job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/properties from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "context" => [
                        "type" => "string",
                        "enum" => [
                            "PROFILE",
                            "OFFER_FORM",
                            "HIRE_FORM",
                            "OFFER_APPROVAL_FORM",
                        ],
                        "required" => false,
                        "description" => "context for candidate properties to display",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_properties_values_batch_update_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesPropertiesValuesBatchUpdateForJob::class,
                'name' => "Add/update candidate properties values",
                'description' => "Add/update candidate properties values\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/properties from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Add/update candidate properties values.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_properties_values_update" => [
                'class' => SmartRecruitersCandidatesCandidatesPropertiesValuesUpdate::class,
                'name' => "Add/update candidate property value",
                'description' => "Add/update candidate property value\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/properties/{propertyId} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "property_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Input value of the candidate property.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_properties_values_update_for_job" => [
                'class' => SmartRecruitersCandidatesCandidatesPropertiesValuesUpdateForJob::class,
                'name' => "Add/update candidate property value",
                'description' => "Add/update candidate property value\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/properties/{propertyId} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "property_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate property id (uuid or key)",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Input value of the candidate property.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_screening_answers_get" => [
                'class' => SmartRecruitersCandidatesCandidatesScreeningAnswersGet::class,
                'name' => "Get candidate screening answers for a candidate's job",
                'description' => "Get candidate screening answers for a candidate's job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/screening-answers from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_add_to_job" => [
                'class' => SmartRecruitersCandidatesCandidatesAddToJob::class,
                'name' => "Create a new candidate and assign to a job",
                'description' => "Create a new candidate and assign to a job\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/candidates from candidates-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Candidate object that needs to be created.",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_resume_add_to_job" => [
                'class' => SmartRecruitersCandidatesCandidatesResumeAddToJob::class,
                'name' => "Parse a resume, create a candidate and assign to a job.",
                'description' => "Parse a resume, create a candidate and assign to a job.\n\nOfficial SmartRecruiters endpoint: POST /jobs/{jobId}/candidates/cv from candidates-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Parse a resume, create a candidate and assign to a job..",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_get_application" => [
                'class' => SmartRecruitersCandidatesCandidatesGetApplication::class,
                'name' => "Get details of a candidate's application to a job",
                'description' => "Get details of a candidate's application to a job\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_candidates_candidates_delete_application" => [
                'class' => SmartRecruitersCandidatesCandidatesDeleteApplication::class,
                'name' => "Delete candidate's application to a job",
                'description' => "Delete candidate's application to a job\n\nOfficial SmartRecruiters endpoint: DELETE /candidates/{id}/jobs/{jobId} from candidates-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_job_applications_job_applications_get_by_id" => [
                'class' => SmartRecruitersJobApplicationsJobApplicationsGetById::class,
                'name' => "Get a job application",
                'description' => "Get a job application\n\nOfficial SmartRecruiters endpoint: GET /job-applications/{jobApplicationId} from job-applications-api.json.",
                'parameters' => [
                    "job_application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of job application",
                    ],
                ],
            ],
            "smartrecruiters_job_applications_job_applications_delete_by_id" => [
                'class' => SmartRecruitersJobApplicationsJobApplicationsDeleteById::class,
                'name' => "Delete a job application",
                'description' => "Delete a job application\n\nOfficial SmartRecruiters endpoint: DELETE /job-applications/{jobApplicationId} from job-applications-api.json.",
                'parameters' => [
                    "job_application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of job application",
                    ],
                ],
            ],
            "smartrecruiters_job_applications_job_applications_post_consent_request" => [
                'class' => SmartRecruitersJobApplicationsJobApplicationsPostConsentRequest::class,
                'name' => "Request consent for a job application",
                'description' => "Request consent for a job application\n\nOfficial SmartRecruiters endpoint: POST /job-applications/{jobApplicationId}/consent-request from job-applications-api.json.",
                'parameters' => [
                    "job_application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of job application",
                    ],
                ],
            ],
            "smartrecruiters_job_applications_job_applications_get_consent_decision" => [
                'class' => SmartRecruitersJobApplicationsJobApplicationsGetConsentDecision::class,
                'name' => "Get consent decisions",
                'description' => "Get consent decisions\n\nOfficial SmartRecruiters endpoint: GET /job-applications/{jobApplicationId}/consents from job-applications-api.json.",
                'parameters' => [
                    "job_application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of job application",
                    ],
                ],
            ],
            "smartrecruiters_messages_messages_shares_create" => [
                'class' => SmartRecruitersMessagesMessagesSharesCreate::class,
                'name' => "Shares new messages on Hireloop with Users, Hiring Teams or Everyone and sends emails.",
                'description' => "Shares new messages on Hireloop with Users, Hiring Teams or Everyone and sends emails.\n\nOfficial SmartRecruiters endpoint: POST /messages/shares from messages-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Message to post",
                    ],
                ],
            ],
            "smartrecruiters_messages_messages_shares_delete" => [
                'class' => SmartRecruitersMessagesMessagesSharesDelete::class,
                'name' => "Delete a message",
                'description' => "Delete a message\n\nOfficial SmartRecruiters endpoint: DELETE /messages/shares/{id} from messages-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "identifier of a message",
                    ],
                ],
            ],
            "smartrecruiters_messages_messages_fetch" => [
                'class' => SmartRecruitersMessagesMessagesFetch::class,
                'name' => "Fetch messages",
                'description' => "Fetch messages\n\nOfficial SmartRecruiters endpoint: GET /messages from messages-api.json.",
                'parameters' => [
                    "candidate_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "identifier of a candidate",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "identifier of a job",
                    ],
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "identifier of next page",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "limit",
                    ],
                ],
            ],
            "smartrecruiters_reviews_scorecards_criteria_get_by_job_id" => [
                'class' => SmartRecruitersReviewsScorecardsCriteriaGetByJobId::class,
                'name' => "Retrieves all criteria for specified job",
                'description' => "Retrieves all criteria for specified job\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/criteria from reviews.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the job",
                    ],
                ],
            ],
            "smartrecruiters_reviews_reviews_get_list" => [
                'class' => SmartRecruitersReviewsReviewsGetList::class,
                'name' => "Retrieves all reviews for specified candidate and job",
                'description' => "Retrieves all reviews for specified candidate and job\n\nOfficial SmartRecruiters endpoint: GET /reviews from reviews.json.",
                'parameters' => [
                    "candidate_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the candidate",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the job",
                    ],
                ],
            ],
            "smartrecruiters_reviews_reviews_create" => [
                'class' => SmartRecruitersReviewsReviewsCreate::class,
                'name' => "Creates a review",
                'description' => "Creates a review\n\nOfficial SmartRecruiters endpoint: POST /reviews from reviews.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Review to be created",
                    ],
                ],
            ],
            "smartrecruiters_reviews_reviews_get" => [
                'class' => SmartRecruitersReviewsReviewsGet::class,
                'name' => "Retrieves a review",
                'description' => "Retrieves a review\n\nOfficial SmartRecruiters endpoint: GET /reviews/{reviewId} from reviews.json.",
                'parameters' => [
                    "review_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the review",
                    ],
                ],
            ],
            "smartrecruiters_reviews_reviews_update" => [
                'class' => SmartRecruitersReviewsReviewsUpdate::class,
                'name' => "Updates a review",
                'description' => "Updates a review\n\nOfficial SmartRecruiters endpoint: PATCH /reviews/{reviewId} from reviews.json.",
                'parameters' => [
                    "review_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the review",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Review to be updated",
                    ],
                ],
            ],
            "smartrecruiters_reviews_reviews_delete" => [
                'class' => SmartRecruitersReviewsReviewsDelete::class,
                'name' => "Deletes a review",
                'description' => "Deletes a review\n\nOfficial SmartRecruiters endpoint: DELETE /reviews/{reviewId} from reviews.json.",
                'parameters' => [
                    "review_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the review",
                    ],
                    "reviewer_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the reviewer",
                    ],
                ],
            ],
            "smartrecruiters_reporting_get_report_files" => [
                'class' => SmartRecruitersReportingGetReportFiles::class,
                'name' => "Get report files",
                'description' => "Get report files\n\nOfficial SmartRecruiters endpoint: GET /reports/{reportId}/files from reporting-api.json.",
                'parameters' => [
                    "page" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Opaque page identifier to be returned.",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Number of entities that should be returned per page.",
                    ],
                    "report_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Report identifier",
                    ],
                ],
            ],
            "smartrecruiters_reporting_generate_ad_hoc_report" => [
                'class' => SmartRecruitersReportingGenerateAdHocReport::class,
                'name' => "Generate ad-hoc report",
                'description' => "Generate ad-hoc report\n\nOfficial SmartRecruiters endpoint: POST /reports/{reportId}/files from reporting-api.json.",
                'parameters' => [
                    "report_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Report identifier",
                    ],
                ],
            ],
            "smartrecruiters_reporting_get_reports" => [
                'class' => SmartRecruitersReportingGetReports::class,
                'name' => "Get reports",
                'description' => "Get reports\n\nOfficial SmartRecruiters endpoint: GET /reports from reporting-api.json.",
                'parameters' => [
                    "page" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Opaque page identifier to be returned.",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Number of entities that should be returned per page.",
                    ],
                ],
            ],
            "smartrecruiters_reporting_get_report" => [
                'class' => SmartRecruitersReportingGetReport::class,
                'name' => "Get report",
                'description' => "Get report\n\nOfficial SmartRecruiters endpoint: GET /reports/{reportId} from reporting-api.json.",
                'parameters' => [
                    "report_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Report identifier",
                    ],
                ],
            ],
            "smartrecruiters_reporting_get_most_recent_report_file" => [
                'class' => SmartRecruitersReportingGetMostRecentReportFile::class,
                'name' => "Get most recent report file",
                'description' => "Get most recent report file\n\nOfficial SmartRecruiters endpoint: GET /reports/{reportId}/files/recent from reporting-api.json.",
                'parameters' => [
                    "report_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Report identifier",
                    ],
                    "if_none_match" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Report file ETag to be compared with the most recent report file",
                    ],
                ],
            ],
            "smartrecruiters_reporting_download_most_recent_report_file" => [
                'class' => SmartRecruitersReportingDownloadMostRecentReportFile::class,
                'name' => "Download most recent report file",
                'description' => "Download most recent report file\n\nOfficial SmartRecruiters endpoint: GET /reports/{reportId}/files/recent/data from reporting-api.json.",
                'parameters' => [
                    "report_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Report identifier",
                    ],
                    "if_none_match" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Report file ETag to be compared with the most recent report file",
                    ],
                ],
            ],
            "smartrecruiters_reporting_get_report_file" => [
                'class' => SmartRecruitersReportingGetReportFile::class,
                'name' => "Get report file",
                'description' => "Get report file\n\nOfficial SmartRecruiters endpoint: GET /files/{reportFileId} from reporting-api.json.",
                'parameters' => [
                    "report_file_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Report file identifier",
                    ],
                ],
            ],
            "smartrecruiters_reporting_download_report_file" => [
                'class' => SmartRecruitersReportingDownloadReportFile::class,
                'name' => "Download report file",
                'description' => "Download report file\n\nOfficial SmartRecruiters endpoint: GET /files/{reportFileId}/data from reporting-api.json.",
                'parameters' => [
                    "report_file_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Report file identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_all" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersAll::class,
                'name' => "List users of your company",
                'description' => "List users of your company\n\nOfficial SmartRecruiters endpoint: GET /users from users-api-deprecated.json.",
                'parameters' => [
                    "q" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "full-text search query based on firstName, lastName, email",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return. max value is 100",
                    ],
                    "offset" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to skip while processing result",
                    ],
                    "updated_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the user update time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_create" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersCreate::class,
                'name' => "Create a new user",
                'description' => "Create a new user\n\nOfficial SmartRecruiters endpoint: POST /users from users-api-deprecated.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "User object to be created",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_me" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersMe::class,
                'name' => "Get details of my user",
                'description' => "Get details of my user\n\nOfficial SmartRecruiters endpoint: GET /users/me from users-api-deprecated.json.",
                'parameters' => [],
            ],
            "smartrecruiters_users_api_deprecated_users_get" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersGet::class,
                'name' => "Get details of a user with given id",
                'description' => "Get details of a user with given id\n\nOfficial SmartRecruiters endpoint: GET /users/{id} from users-api-deprecated.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_activation_delete" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersActivationDelete::class,
                'name' => "Deactivate a user",
                'description' => "Deactivate a user\n\nOfficial SmartRecruiters endpoint: DELETE /users/{id} from users-api-deprecated.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_update" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersUpdate::class,
                'name' => "Update a user",
                'description' => "Update a user\n\nOfficial SmartRecruiters endpoint: PATCH /users/{id} from users-api-deprecated.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "patch request",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_activation_email_send" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersActivationEmailSend::class,
                'name' => "Send an activation email to a user",
                'description' => "Send an activation email to a user\n\nOfficial SmartRecruiters endpoint: POST /users/{id}/activation-email from users-api-deprecated.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_activation_activate" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersActivationActivate::class,
                'name' => "Activate a user",
                'description' => "Activate a user\n\nOfficial SmartRecruiters endpoint: PUT /users/{id}/activation from users-api-deprecated.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_activation_deactivate" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersActivationDeactivate::class,
                'name' => "Deactivate a user",
                'description' => "Deactivate a user\n\nOfficial SmartRecruiters endpoint: DELETE /users/{id}/activation from users-api-deprecated.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_api_deprecated_users_avatar_update" => [
                'class' => SmartRecruitersUsersApiDeprecatedUsersAvatarUpdate::class,
                'name' => "Update user avatar",
                'description' => "Update user avatar\n\nOfficial SmartRecruiters endpoint: PUT /users/{id}/avatar from users-api-deprecated.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters users-api-deprecated.json schema for Update user avatar.",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_new_hires_get" => [
                'class' => SmartRecruitersSmartonboardNewHiresGet::class,
                'name' => "Returns details for a single New Hire",
                'description' => "Returns details for a single New Hire\n\nOfficial SmartRecruiters endpoint: GET /new-hires/{newHireId} from smartonboard.json.",
                'parameters' => [
                    "new_hire_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the New Hire",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_onboarding_processes_get" => [
                'class' => SmartRecruitersSmartonboardOnboardingProcessesGet::class,
                'name' => "Returns details of a single Onboarding Process",
                'description' => "Returns details of a single Onboarding Process\n\nOfficial SmartRecruiters endpoint: GET /onboarding-processes/{onboardingProcessId} from smartonboard.json.",
                'parameters' => [
                    "onboarding_process_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Onboarding Process",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_web_form_assignments_form_answers_get" => [
                'class' => SmartRecruitersSmartonboardWebFormAssignmentsFormAnswersGet::class,
                'name' => "Returns answers submitted for a single Web Form Assignment",
                'description' => "Returns answers submitted for a single Web Form Assignment\n\nOfficial SmartRecruiters endpoint: GET /web-form-assignments/{webFormAssignmentId}/form-answers from smartonboard.json.",
                'parameters' => [
                    "web_form_assignment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Web Form Assignment",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_web_form_assignments_fields_metadata_get" => [
                'class' => SmartRecruitersSmartonboardWebFormAssignmentsFieldsMetadataGet::class,
                'name' => "Returns metadata for the fields that belong to a single Web Form Assignment",
                'description' => "Returns metadata for the fields that belong to a single Web Form Assignment\n\nOfficial SmartRecruiters endpoint: GET /web-form-assignments/{webFormAssignmentId}/fields-metadata from smartonboard.json.",
                'parameters' => [
                    "web_form_assignment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Web Form Assignment",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_fillable_pdf_form_assignments_form_answers_get" => [
                'class' => SmartRecruitersSmartonboardFillablePdfFormAssignmentsFormAnswersGet::class,
                'name' => "Returns answers submitted for a single Fillable PDF Form Assignment",
                'description' => "Returns answers submitted for a single Fillable PDF Form Assignment\n\nOfficial SmartRecruiters endpoint: GET /fillable-pdf-form-assignments/{fillablePdfFormAssignmentId}/form-answers from smartonboard.json.",
                'parameters' => [
                    "fillable_pdf_form_assignment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Fillable PDF Form Assignment",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_onboarding_processes_assignments_get" => [
                'class' => SmartRecruitersSmartonboardOnboardingProcessesAssignmentsGet::class,
                'name' => "Returns Assignments associated with a single Onboarding Process",
                'description' => "Returns Assignments associated with a single Onboarding Process\n\nOfficial SmartRecruiters endpoint: GET /onboarding-processes/{onboardingProcessId}/assignments from smartonboard.json.",
                'parameters' => [
                    "onboarding_process_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Onboarding Process",
                    ],
                    "integration_relevant" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "Indicate if only assignments that have integration key defined should be fetched. By default set to false",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_onboarding_processes_assignment_get" => [
                'class' => SmartRecruitersSmartonboardOnboardingProcessesAssignmentGet::class,
                'name' => "Returns specific Assignment associated with a single Onboarding Process",
                'description' => "Returns specific Assignment associated with a single Onboarding Process\n\nOfficial SmartRecruiters endpoint: GET /onboarding-processes/{onboardingProcessId}/assignments/{assignmentId} from smartonboard.json.",
                'parameters' => [
                    "onboarding_process_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Onboarding Process",
                    ],
                    "assignment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Assignment",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_activity_assignments_attachments_get" => [
                'class' => SmartRecruitersSmartonboardActivityAssignmentsAttachmentsGet::class,
                'name' => "Returns list of Attachments submitted for a single Activity Assignment",
                'description' => "Returns list of Attachments submitted for a single Activity Assignment\n\nOfficial SmartRecruiters endpoint: GET /activity-assignments/{activityAssignmentId}/attachments from smartonboard.json.",
                'parameters' => [
                    "activity_assignment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Activity Assignment",
                    ],
                ],
            ],
            "smartrecruiters_smartonboard_activity_assignments_attachments_get_by_id" => [
                'class' => SmartRecruitersSmartonboardActivityAssignmentsAttachmentsGetById::class,
                'name' => "Returns single Attachment for specific Activity Assignment",
                'description' => "Returns single Attachment for specific Activity Assignment\n\nOfficial SmartRecruiters endpoint: GET /activity-assignments/{activityAssignmentId}/attachments/{attachmentId} from smartonboard.json.",
                'parameters' => [
                    "activity_assignment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Activity Assignment",
                    ],
                    "attachment_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "ID of the Attachment",
                    ],
                ],
            ],
            "smartrecruiters_users_users_all" => [
                'class' => SmartRecruitersUsersUsersAll::class,
                'name' => "List users of your company",
                'description' => "List users of your company\n\nOfficial SmartRecruiters endpoint: GET /users from users-api.json.",
                'parameters' => [
                    "q" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "full-text search query based on firstName, lastName, email, externalData",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return. max value is 100",
                    ],
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Unique identifier for the next page of users",
                    ],
                    "updated_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the user update time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                ],
            ],
            "smartrecruiters_users_users_create" => [
                'class' => SmartRecruitersUsersUsersCreate::class,
                'name' => "Create a new user.",
                'description' => "Create a new user.\n\nOfficial SmartRecruiters endpoint: POST /users from users-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "User object to be created",
                    ],
                ],
            ],
            "smartrecruiters_users_users_me" => [
                'class' => SmartRecruitersUsersUsersMe::class,
                'name' => "Get details of my user",
                'description' => "Get details of my user\n\nOfficial SmartRecruiters endpoint: GET /users/me from users-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_users_users_get" => [
                'class' => SmartRecruitersUsersUsersGet::class,
                'name' => "Get details of a user with given id",
                'description' => "Get details of a user with given id\n\nOfficial SmartRecruiters endpoint: GET /users/{id} from users-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_users_update" => [
                'class' => SmartRecruitersUsersUsersUpdate::class,
                'name' => "Update a user",
                'description' => "Update a user\n\nOfficial SmartRecruiters endpoint: PATCH /users/{id} from users-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "patch request (RFC 6902 - https://datatracker.ietf.org/doc/html/rfc6902)",
                    ],
                ],
            ],
            "smartrecruiters_users_users_password_reset" => [
                'class' => SmartRecruitersUsersUsersPasswordReset::class,
                'name' => "Send a password reset email to a user",
                'description' => "Send a password reset email to a user\n\nOfficial SmartRecruiters endpoint: POST /users/{id}/reset-password from users-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_users_activation_email_send" => [
                'class' => SmartRecruitersUsersUsersActivationEmailSend::class,
                'name' => "Send an activation email to a user",
                'description' => "Send an activation email to a user\n\nOfficial SmartRecruiters endpoint: POST /users/{id}/activation-email from users-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_users_activation_activate" => [
                'class' => SmartRecruitersUsersUsersActivationActivate::class,
                'name' => "Activate a user",
                'description' => "Activate a user\n\nOfficial SmartRecruiters endpoint: PUT /users/{id}/activation from users-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_users_activation_deactivate" => [
                'class' => SmartRecruitersUsersUsersActivationDeactivate::class,
                'name' => "Deactivate a user",
                'description' => "Deactivate a user\n\nOfficial SmartRecruiters endpoint: DELETE /users/{id}/activation from users-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_users_avatar_update" => [
                'class' => SmartRecruitersUsersUsersAvatarUpdate::class,
                'name' => "Update user avatar",
                'description' => "Update user avatar\n\nOfficial SmartRecruiters endpoint: PUT /users/{id}/avatar from users-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters users-api.json schema for Update user avatar.",
                    ],
                ],
            ],
            "smartrecruiters_users_system_roles_all" => [
                'class' => SmartRecruitersUsersSystemRolesAll::class,
                'name' => "List system roles",
                'description' => "List system roles\n\nOfficial SmartRecruiters endpoint: GET /system-roles from users-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_users_access_groups_all" => [
                'class' => SmartRecruitersUsersAccessGroupsAll::class,
                'name' => "List access groups configured in your company",
                'description' => "List access groups configured in your company\n\nOfficial SmartRecruiters endpoint: GET /access-groups from users-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_users_access_groups_users_remove" => [
                'class' => SmartRecruitersUsersAccessGroupsUsersRemove::class,
                'name' => "Remove user from access group",
                'description' => "Remove user from access group\n\nOfficial SmartRecruiters endpoint: DELETE /access-groups/{accessGroupId}/users/{id} from users-api.json.",
                'parameters' => [
                    "access_group_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "access group identifier",
                    ],
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "user identifier",
                    ],
                ],
            ],
            "smartrecruiters_users_access_groups_users_assign" => [
                'class' => SmartRecruitersUsersAccessGroupsUsersAssign::class,
                'name' => "Assign users to access group",
                'description' => "Assign users to access group\n\nOfficial SmartRecruiters endpoint: POST /access-groups/{accessGroupId}/users from users-api.json.",
                'parameters' => [
                    "access_group_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "access group identifier",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters users-api.json schema for Assign users to access group.",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_create" => [
                'class' => SmartRecruitersWebhooksSubscriptionsCreate::class,
                'name' => "Subscribe to a webhook.",
                'description' => "Subscribe to a webhook.\n\nOfficial SmartRecruiters endpoint: POST /subscriptions from webhooks.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters webhooks.json schema for Subscribe to a webhook..",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_get_all" => [
                'class' => SmartRecruitersWebhooksSubscriptionsGetAll::class,
                'name' => "Retrieve webhook subscriptions.",
                'description' => "Retrieve webhook subscriptions.\n\nOfficial SmartRecruiters endpoint: GET /subscriptions from webhooks.json.",
                'parameters' => [
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "identifier of the next page of subscriptions",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_get" => [
                'class' => SmartRecruitersWebhooksSubscriptionsGet::class,
                'name' => "Retrieve single webhook subscription.",
                'description' => "Retrieve single webhook subscription.\n\nOfficial SmartRecruiters endpoint: GET /subscriptions/{id} from webhooks.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "subscription identifier",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_delete" => [
                'class' => SmartRecruitersWebhooksSubscriptionsDelete::class,
                'name' => "Delete webhook subscription.",
                'description' => "Delete webhook subscription.\n\nOfficial SmartRecruiters endpoint: DELETE /subscriptions/{id} from webhooks.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "subscription identifier",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_activate" => [
                'class' => SmartRecruitersWebhooksSubscriptionsActivate::class,
                'name' => "Activate webhook subscription.",
                'description' => "Activate webhook subscription.\n\nOfficial SmartRecruiters endpoint: PUT /subscriptions/{id}/activation from webhooks.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "subscription identifier",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_generate_secret_key" => [
                'class' => SmartRecruitersWebhooksSubscriptionsGenerateSecretKey::class,
                'name' => "Generate a secret key for a webhook subscription.",
                'description' => "Generate a secret key for a webhook subscription.\n\nOfficial SmartRecruiters endpoint: POST /subscriptions/{id}/secret-key from webhooks.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "subscription identifier",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_get_secret_key" => [
                'class' => SmartRecruitersWebhooksSubscriptionsGetSecretKey::class,
                'name' => "Retrieve subscription secret key",
                'description' => "Retrieve subscription secret key\n\nOfficial SmartRecruiters endpoint: GET /subscriptions/{id}/secret-key from webhooks.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "subscription identifier",
                    ],
                ],
            ],
            "smartrecruiters_webhooks_subscriptions_search_callback_log" => [
                'class' => SmartRecruitersWebhooksSubscriptionsSearchCallbackLog::class,
                'name' => "Retrieve callback request details starting from the newest.",
                'description' => "Retrieve callback request details starting from the newest.\n\nOfficial SmartRecruiters endpoint: GET /subscriptions/{id}/callbacks-log from webhooks.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "subscription identifier",
                    ],
                    "page_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "identifier of the next page of subscriptions",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return",
                    ],
                    "callback_status" => [
                        "type" => "string",
                        "enum" => [
                            "successful",
                            "failed",
                        ],
                        "required" => false,
                        "description" => "status of callback, when absent all statuses will be returned",
                    ],
                    "after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Requests sent after the timestamp. The minimum value is 30 days ago. Format ISO8601: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                    "before" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Requests sent before timestamp. The minimum value is 30 days ago. Format ISO8601: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_get_partner_config" => [
                'class' => SmartRecruitersAssessmentPartnerGetPartnerConfig::class,
                'name' => "get partner configuration",
                'description' => "get partner configuration\n\nOfficial SmartRecruiters endpoint: GET /partner/configuration from assessment-partner-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_assessment_partner_save_partner_config" => [
                'class' => SmartRecruitersAssessmentPartnerSavePartnerConfig::class,
                'name' => "saves configuration for partner",
                'description' => "saves configuration for partner\n\nOfficial SmartRecruiters endpoint: PUT /partner/configuration from assessment-partner-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for saves configuration for partner.",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_set_up_integration" => [
                'class' => SmartRecruitersAssessmentPartnerSetUpIntegration::class,
                'name' => "enable the company integration",
                'description' => "enable the company integration\n\nOfficial SmartRecruiters endpoint: POST /integration/company/{companyId} from assessment-partner-api.json.",
                'parameters' => [
                    "company_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `companyId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for enable the company integration.",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_package_result_update" => [
                'class' => SmartRecruitersAssessmentPartnerPackageResultUpdate::class,
                'name' => "updates package result",
                'description' => "updates package result\n\nOfficial SmartRecruiters endpoint: PATCH /orders/{orderId}/results from assessment-partner-api.json.",
                'parameters' => [
                    "order_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Order ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for updates package result.",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_add_attachment_to_order" => [
                'class' => SmartRecruitersAssessmentPartnerAddAttachmentToOrder::class,
                'name' => "add attachment to order",
                'description' => "add attachment to order\n\nOfficial SmartRecruiters endpoint: POST /orders/{orderId}/results/attachment from assessment-partner-api.json.",
                'parameters' => [
                    "order_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Order ID",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for add attachment to order.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_get_event_details" => [
                'class' => SmartRecruitersEventManagementGetEventDetails::class,
                'name' => "Get event's details",
                'description' => "Get event's details\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId} from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_update_event" => [
                'class' => SmartRecruitersEventManagementUpdateEvent::class,
                'name' => "Update event",
                'description' => "Update event\n\nOfficial SmartRecruiters endpoint: PUT /events/{eventId} from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Update event.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_delete_event" => [
                'class' => SmartRecruitersEventManagementDeleteEvent::class,
                'name' => "Delete event",
                'description' => "Delete event\n\nOfficial SmartRecruiters endpoint: DELETE /events/{eventId} from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_add_interviewers_to_session" => [
                'class' => SmartRecruitersEventManagementAddInterviewersToSession::class,
                'name' => "Add interviewers to event's session",
                'description' => "Add interviewers to event's session\n\nOfficial SmartRecruiters endpoint: PUT /events/{eventId}/sessions/{sessionId}/interviewers from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "session_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `sessionId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Add interviewers to event's session.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_remove_interviewers_from_session" => [
                'class' => SmartRecruitersEventManagementRemoveInterviewersFromSession::class,
                'name' => "Remove interviewers from event's session",
                'description' => "Remove interviewers from event's session\n\nOfficial SmartRecruiters endpoint: DELETE /events/{eventId}/sessions/{sessionId}/interviewers from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "session_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `sessionId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Remove interviewers from event's session.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_move_applicants_to_session" => [
                'class' => SmartRecruitersEventManagementMoveApplicantsToSession::class,
                'name' => "Move applicants from session to session",
                'description' => "Move applicants from session to session\n\nOfficial SmartRecruiters endpoint: PUT /events/{eventId}/sessions/{sessionId}/applicants from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "session_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `sessionId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Move applicants from session to session.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_add_applicants_to_session" => [
                'class' => SmartRecruitersEventManagementAddApplicantsToSession::class,
                'name' => "Add applicants from event pool to session",
                'description' => "Add applicants from event pool to session\n\nOfficial SmartRecruiters endpoint: POST /events/{eventId}/sessions/{sessionId}/applicants from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "session_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `sessionId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Add applicants from event pool to session.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_get_events" => [
                'class' => SmartRecruitersEventManagementGetEvents::class,
                'name' => "Get job's events",
                'description' => "Get job's events\n\nOfficial SmartRecruiters endpoint: GET /events from event-management-api.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Job ID",
                    ],
                    "state" => [
                        "type" => "string",
                        "enum" => [
                            "PAST",
                            "ACTIVE",
                        ],
                        "required" => true,
                        "description" => "Event state",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Page number beginning from 0",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Page size default is 10",
                    ],
                ],
            ],
            "smartrecruiters_event_management_create_event" => [
                'class' => SmartRecruitersEventManagementCreateEvent::class,
                'name' => "Create event",
                'description' => "Create event\n\nOfficial SmartRecruiters endpoint: POST /events from event-management-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Create event.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_get_all_applicants" => [
                'class' => SmartRecruitersEventManagementGetAllApplicants::class,
                'name' => "Get all applicants (both event-applicants-pool and session-applicants) for specified event",
                'description' => "Get all applicants (both event-applicants-pool and session-applicants) for specified event\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId}/applicants from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_add_applicants_to_event" => [
                'class' => SmartRecruitersEventManagementAddApplicantsToEvent::class,
                'name' => "Add applicants to event pool",
                'description' => "Add applicants to event pool\n\nOfficial SmartRecruiters endpoint: POST /events/{eventId}/applicants from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters event-management-api.json schema for Add applicants to event pool.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_get_session_details" => [
                'class' => SmartRecruitersEventManagementGetSessionDetails::class,
                'name' => "Get event's session details",
                'description' => "Get event's session details\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId}/sessions/{sessionId} from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "session_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `sessionId`.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_delete_session" => [
                'class' => SmartRecruitersEventManagementDeleteSession::class,
                'name' => "Delete event's session",
                'description' => "Delete event's session\n\nOfficial SmartRecruiters endpoint: DELETE /events/{eventId}/sessions/{sessionId} from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "session_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `sessionId`.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_get_applicants_by_event_id" => [
                'class' => SmartRecruitersEventManagementGetApplicantsByEventId::class,
                'name' => "Get event's applicants",
                'description' => "Get event's applicants\n\nOfficial SmartRecruiters endpoint: GET /events/{eventId}/pool-applicants from event-management-api.json.",
                'parameters' => [
                    "event_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `eventId`.",
                    ],
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "query parameter `page`.",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "query parameter `pageSize`.",
                    ],
                ],
            ],
            "smartrecruiters_event_management_get_events_for_candidate" => [
                'class' => SmartRecruitersEventManagementGetEventsForCandidate::class,
                'name' => "Get candidate events",
                'description' => "Get candidate events\n\nOfficial SmartRecruiters endpoint: GET /events/candidates/{profileId} from event-management-api.json.",
                'parameters' => [
                    "profile_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Candidate profile ID",
                    ],
                    "state" => [
                        "type" => "string",
                        "enum" => [
                            "PAST",
                            "ACTIVE",
                        ],
                        "required" => true,
                        "description" => "Event state",
                    ],
                ],
            ],
            "smartrecruiters_event_management_get_events_for_application" => [
                'class' => SmartRecruitersEventManagementGetEventsForApplication::class,
                'name' => "Get application events",
                'description' => "Get application events\n\nOfficial SmartRecruiters endpoint: GET /events/applications/{applicationId} from event-management-api.json.",
                'parameters' => [
                    "application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Application ID",
                    ],
                    "state" => [
                        "type" => "string",
                        "enum" => [
                            "PAST",
                            "ACTIVE",
                        ],
                        "required" => true,
                        "description" => "Event state",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_app_ask_for_consent" => [
                'class' => SmartRecruitersAssessmentPartnerAppAskForConsent::class,
                'name' => "Shows consent form on partner side",
                'description' => "Shows consent form on partner side\n\nOfficial SmartRecruiters endpoint: GET /integration from assessment-partner-app.json.",
                'parameters' => [
                    "company_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "id of company setting up the integration",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_app_delete_integration" => [
                'class' => SmartRecruitersAssessmentPartnerAppDeleteIntegration::class,
                'name' => "Removes integration on partner side",
                'description' => "Removes integration on partner side\n\nOfficial SmartRecruiters endpoint: DELETE /integrations/companies/{companyId} from assessment-partner-app.json.",
                'parameters' => [
                    "company_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "id of company with integration",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_app_list_packages" => [
                'class' => SmartRecruitersAssessmentPartnerAppListPackages::class,
                'name' => "Retrieves a list of packages",
                'description' => "Retrieves a list of packages\n\nOfficial SmartRecruiters endpoint: GET /packages from assessment-partner-app.json.",
                'parameters' => [
                    "requester" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Information about recruiter requesting list of packages",
                    ],
                    "country_code" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "country code",
                    ],
                    "region_abbr" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "region abbreviation",
                    ],
                    "city" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "city",
                    ],
                    "address" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "address",
                    ],
                    "postal_code" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "postal code",
                    ],
                    "remote" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "describe whether job is remote or not",
                    ],
                    "partner_field_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Example partner field. Partner defines list of allowed fields in configuration. Client binds job fields in his configuration. All fields with non-empty values will be included in this call.",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_app_get_package_by_id" => [
                'class' => SmartRecruitersAssessmentPartnerAppGetPackageById::class,
                'name' => "Retrieves a package by id",
                'description' => "Retrieves a package by id\n\nOfficial SmartRecruiters endpoint: GET /packages/{assessmentPackageId} from assessment-partner-app.json.",
                'parameters' => [
                    "assessment_package_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `assessmentPackageId`.",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_app_orders_assessment_package" => [
                'class' => SmartRecruitersAssessmentPartnerAppOrdersAssessmentPackage::class,
                'name' => "Orders assessment package for candidate",
                'description' => "Orders assessment package for candidate\n\nOfficial SmartRecruiters endpoint: POST /packages/orders from assessment-partner-app.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters assessment-partner-app.json schema for Orders assessment package for candidate.",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_app_orders_inline_assessment_package" => [
                'class' => SmartRecruitersAssessmentPartnerAppOrdersInlineAssessmentPackage::class,
                'name' => "Orders inline assessment package for candidate",
                'description' => "Orders inline assessment package for candidate\n\nOfficial SmartRecruiters endpoint: POST /packages/inline/orders from assessment-partner-app.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters assessment-partner-app.json schema for Orders inline assessment package for candidate.",
                    ],
                ],
            ],
            "smartrecruiters_assessment_partner_app_get_token" => [
                'class' => SmartRecruitersAssessmentPartnerAppGetToken::class,
                'name' => "Exchange credentials for an access token",
                'description' => "Exchange credentials for an access token\n\nOfficial SmartRecruiters endpoint: POST /oauth/token from assessment-partner-app.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Request body matching the official SmartRecruiters assessment-partner-app.json schema for Exchange credentials for an access token.",
                    ],
                ],
            ],
            "smartrecruiters_apps_integrations_enable_integration" => [
                'class' => SmartRecruitersAppsIntegrationsEnableIntegration::class,
                'name' => "Enables integration",
                'description' => "Enables integration\n\nOfficial SmartRecruiters endpoint: POST /partner-api/integrations from apps-integrations.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters apps-integrations.json schema for Enables integration.",
                    ],
                ],
            ],
            "smartrecruiters_candidate_status_get_status" => [
                'class' => SmartRecruitersCandidateStatusGetStatus::class,
                'name' => "Get candidate status",
                'description' => "Get candidate status\n\nOfficial SmartRecruiters endpoint: GET /status/{applicationUuid} from candidate-status-api.json.",
                'parameters' => [
                    "application_uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `applicationUuid`.",
                    ],
                ],
            ],
            "smartrecruiters_feed_find_posting_using_json" => [
                'class' => SmartRecruitersFeedFindPostingUsingJson::class,
                'name' => "Get posting by id",
                'description' => "Get posting by id\n\nOfficial SmartRecruiters endpoint: GET /publications/{postingId} from feed-api.json.",
                'parameters' => [
                    "posting_id" => [
                        "type" => "integer",
                        "required" => true,
                        "description" => "Posting id to find",
                    ],
                ],
            ],
            "smartrecruiters_feed_update_posting_using_json" => [
                'class' => SmartRecruitersFeedUpdatePostingUsingJson::class,
                'name' => "Update posting information",
                'description' => "Update posting information\n\nOfficial SmartRecruiters endpoint: PUT /publications/{postingId} from feed-api.json.",
                'parameters' => [
                    "posting_id" => [
                        "type" => "integer",
                        "required" => true,
                        "description" => "A single posting id. Allows updating information only for the defined postings.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters feed-api.json schema for Update posting information.",
                    ],
                ],
            ],
            "smartrecruiters_feed_postings_json_stream" => [
                'class' => SmartRecruitersFeedPostingsJsonStream::class,
                'name' => "Get a list of postings",
                'description' => "Get a list of postings\n\nOfficial SmartRecruiters endpoint: GET /publications from feed-api.json.",
                'parameters' => [
                    "updated_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "List postings created after the specified date.Date should be in ISO 8601 format: (e.g.: '2015-07-27T08:43:33.000Z').If no value is provided, only postings created in the last 30 days will be returned.",
                    ],
                    "status" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "Pending",
                                "UnderPosting",
                                "Active",
                                "toUnpost",
                                "Inactive",
                                "Error",
                            ],
                        ],
                        "required" => false,
                        "description" => "List of posting statuses separated by comma.Status definition:Pending - this is a new posting that is pending publication on your job board. You should always retrieve these postings, publish them, and then update the status via the PUT method.UnderPosting - this is a status that is only set by you. It indicates that a posting is currently being published but is not yet available on the job board. SmartRecruiters will never set this status ourselves.Active - this is a status that is only set by you. It indicates that the posting has been successfully published and is available on the job board. SmartRecruiters will never set this status ourselves.toUnpost - this posting has either expired or has manually been requested for removal by the client. As a job board, you should unpost these postings immediately, and then update the status to Inactive via the PUT method.Inactive - this is a status that is only set by you. It indicates that the posting has been successfully unpublished and is no longer available on the job board. SmartRecruiters will never set this status ourselves.Error - this is a status only set by you. It indicates that the posting could not be published. SmartRecruiters will never set this status ourselves.Example: status=Active,Error",
                    ],
                    "offset" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Number of elements to skip while processing result.Allowed range: [0, 2^31-1].",
                    ],
                    "limit" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Maximum number of postings returned.Allowed range: [0, 100].",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_get_template_by_id" => [
                'class' => SmartRecruitersInterviewTemplatesGetTemplateById::class,
                'name' => "Get interview template by id.",
                'description' => "Get interview template by id.\n\nOfficial SmartRecruiters endpoint: GET /templates/{id} from interview-templates.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_update_template" => [
                'class' => SmartRecruitersInterviewTemplatesUpdateTemplate::class,
                'name' => "Update interview template.",
                'description' => "Update interview template.\n\nOfficial SmartRecruiters endpoint: PUT /templates/{id} from interview-templates.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update interview template..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_delete_template" => [
                'class' => SmartRecruitersInterviewTemplatesDeleteTemplate::class,
                'name' => "Removes interview template.",
                'description' => "Removes interview template.\n\nOfficial SmartRecruiters endpoint: DELETE /templates/{id} from interview-templates.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_get_job_managed_steps" => [
                'class' => SmartRecruitersInterviewTemplatesGetJobManagedSteps::class,
                'name' => "Get managed hiring process steps for the job.",
                'description' => "Get managed hiring process steps for the job.\n\nOfficial SmartRecruiters endpoint: GET /managed-steps/jobs/{jobId} from interview-templates.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The job id",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_update_job_managed_steps" => [
                'class' => SmartRecruitersInterviewTemplatesUpdateJobManagedSteps::class,
                'name' => "Update managed steps for the job.",
                'description' => "Update managed steps for the job.\n\nOfficial SmartRecruiters endpoint: PUT /managed-steps/jobs/{jobId} from interview-templates.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The job id",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update managed steps for the job..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_update_job_template" => [
                'class' => SmartRecruitersInterviewTemplatesUpdateJobTemplate::class,
                'name' => "Update job level interview template.",
                'description' => "Update job level interview template.\n\nOfficial SmartRecruiters endpoint: PUT /job-templates/{jobInterviewTemplateId} from interview-templates.json.",
                'parameters' => [
                    "job_interview_template_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The job level interview templates id",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update job level interview template..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_patch_job_template_interviewers" => [
                'class' => SmartRecruitersInterviewTemplatesPatchJobTemplateInterviewers::class,
                'name' => "Patches job level interview template's interviewers pool.",
                'description' => "Patches job level interview template's interviewers pool.\n\nOfficial SmartRecruiters endpoint: PATCH /job-templates/{jobInterviewTemplateId} from interview-templates.json.",
                'parameters' => [
                    "job_interview_template_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job level interview template id",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Patches job level interview template's interviewers pool..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_find_job_template_by_hiring_state" => [
                'class' => SmartRecruitersInterviewTemplatesFindJobTemplateByHiringState::class,
                'name' => "Finds job level interview templates for job id, hiring step and hiring stage.",
                'description' => "Finds job level interview templates for job id, hiring step and hiring stage.\n\nOfficial SmartRecruiters endpoint: GET /job-templates/jobs/{jobId}/hiringStages/{hiringStage} from interview-templates.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Job id",
                    ],
                    "hiring_stage" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Hiring stage",
                    ],
                    "hiring_step" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Hiring step",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_upsert_job_template" => [
                'class' => SmartRecruitersInterviewTemplatesUpsertJobTemplate::class,
                'name' => "Save / replace job level interview templates for job id, hiring step and hiring stage.",
                'description' => "Save / replace job level interview templates for job id, hiring step and hiring stage.\n\nOfficial SmartRecruiters endpoint: PUT /job-templates/jobs/{jobId}/hiringStages/{hiringStage} from interview-templates.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Job id",
                    ],
                    "hiring_stage" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Hiring stage",
                    ],
                    "hiring_step" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Hiring step",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Save / replace job level interview templates for job id, hiring step and hiring stage..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_get_interview_template_by_id" => [
                'class' => SmartRecruitersInterviewTemplatesGetInterviewTemplateById::class,
                'name' => "Get interview template by id.",
                'description' => "Get interview template by id.\n\nOfficial SmartRecruiters endpoint: GET /interview/templates/{id} from interview-templates.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The interview template id.",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_update_interview_template" => [
                'class' => SmartRecruitersInterviewTemplatesUpdateInterviewTemplate::class,
                'name' => "Update interview template by id.",
                'description' => "Update interview template by id.\n\nOfficial SmartRecruiters endpoint: PUT /interview/templates/{id} from interview-templates.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The interview template id.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update interview template by id..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_delete_interview_template" => [
                'class' => SmartRecruitersInterviewTemplatesDeleteInterviewTemplate::class,
                'name' => "Remove interview template by id.",
                'description' => "Remove interview template by id.\n\nOfficial SmartRecruiters endpoint: DELETE /interview/templates/{id} from interview-templates.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The interview template id.",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_update_job_interview_template" => [
                'class' => SmartRecruitersInterviewTemplatesUpdateJobInterviewTemplate::class,
                'name' => "Update job interview template.",
                'description' => "Update job interview template.\n\nOfficial SmartRecruiters endpoint: PUT /interview/templates/job/{jobInterviewTemplateId} from interview-templates.json.",
                'parameters' => [
                    "job_interview_template_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The job interview template id",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update job interview template..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_update_job_interview_template_interviewers" => [
                'class' => SmartRecruitersInterviewTemplatesUpdateJobInterviewTemplateInterviewers::class,
                'name' => "Update interviewers selection for job interview template.",
                'description' => "Update interviewers selection for job interview template.\n\nOfficial SmartRecruiters endpoint: PATCH /interview/templates/job/{jobInterviewTemplateId} from interview-templates.json.",
                'parameters' => [
                    "job_interview_template_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The job interview template id",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update interviewers selection for job interview template..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_get_templates" => [
                'class' => SmartRecruitersInterviewTemplatesGetTemplates::class,
                'name' => "Get interview templates for the current company.",
                'description' => "Get interview templates for the current company.\n\nOfficial SmartRecruiters endpoint: GET /templates from interview-templates.json.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Page number beginning from 0",
                    ],
                    "page_size" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "Page size default is 20",
                    ],
                    "hiring_stage" => [
                        "type" => "string",
                        "enum" => [
                            "NEW",
                            "IN_PROGRESS",
                            "INTERVIEW",
                            "OFFER",
                        ],
                        "required" => false,
                        "description" => "Hiring stage (if used both Hiring stage and Hiring step must be used)",
                    ],
                    "hiring_step" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Hiring step (if used both Hiring stage and Hiring step must be used)",
                    ],
                    "type" => [
                        "type" => "string",
                        "enum" => [
                            "INDIVIDUAL",
                            "GROUP",
                        ],
                        "required" => false,
                        "description" => "Type of the template (if not passed in then will return all types)",
                    ],
                    "search" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "query parameter `search`.",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_create_template" => [
                'class' => SmartRecruitersInterviewTemplatesCreateTemplate::class,
                'name' => "Create a interview template.",
                'description' => "Create a interview template.\n\nOfficial SmartRecruiters endpoint: POST /templates from interview-templates.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Create a interview template..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_search_job_template_by_job_application_ids" => [
                'class' => SmartRecruitersInterviewTemplatesSearchJobTemplateByJobApplicationIds::class,
                'name' => "Finds job level interview templates by job application IDs",
                'description' => "Finds job level interview templates by job application IDs\n\nOfficial SmartRecruiters endpoint: POST /job-templates/jobs/{jobId}/search from interview-templates.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Job id",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Finds job level interview templates by job application IDs.",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_search_interview_templates" => [
                'class' => SmartRecruitersInterviewTemplatesSearchInterviewTemplates::class,
                'name' => "Search for all interview templates.",
                'description' => "Search for all interview templates.\n\nOfficial SmartRecruiters endpoint: GET /interview/templates from interview-templates.json.",
                'parameters' => [
                    "page" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The page number to retrieve.",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "The number of items per page.",
                    ],
                    "search" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "The search query to filter the results. By default all items are returned.",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_create_interview_template" => [
                'class' => SmartRecruitersInterviewTemplatesCreateInterviewTemplate::class,
                'name' => "Create interview template.",
                'description' => "Create interview template.\n\nOfficial SmartRecruiters endpoint: POST /interview/templates from interview-templates.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Create interview template..",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_get_schedule_preferences" => [
                'class' => SmartRecruitersInterviewTemplatesGetSchedulePreferences::class,
                'name' => "Find schedule preferences",
                'description' => "Find schedule preferences\n\nOfficial SmartRecruiters endpoint: GET /schedule/preferences/users/{userId} from interview-templates.json.",
                'parameters' => [
                    "user_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of the user for which schedule preferences should be found",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_find_job_templates_by_job_id" => [
                'class' => SmartRecruitersInterviewTemplatesFindJobTemplatesByJobId::class,
                'name' => "Finds job level interview templates for a job",
                'description' => "Finds job level interview templates for a job\n\nOfficial SmartRecruiters endpoint: GET /job-templates/jobs/{jobId} from interview-templates.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Job id",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_find_job_template_by_application_id" => [
                'class' => SmartRecruitersInterviewTemplatesFindJobTemplateByApplicationId::class,
                'name' => "Finds job level interview templates by job application id",
                'description' => "Finds job level interview templates by job application id\n\nOfficial SmartRecruiters endpoint: GET /job-templates/job-applications/{applicationId} from interview-templates.json.",
                'parameters' => [
                    "application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "application id",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_get_job_interview_templates" => [
                'class' => SmartRecruitersInterviewTemplatesGetJobInterviewTemplates::class,
                'name' => "Find interview templates for the job",
                'description' => "Find interview templates for the job\n\nOfficial SmartRecruiters endpoint: GET /interview/templates/jobs/{jobId} from interview-templates.json.",
                'parameters' => [
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The job id",
                    ],
                ],
            ],
            "smartrecruiters_interview_templates_get_job_application_interview_templates" => [
                'class' => SmartRecruitersInterviewTemplatesGetJobApplicationInterviewTemplates::class,
                'name' => "Find interview templates for job application id.",
                'description' => "Find interview templates for job application id.\n\nOfficial SmartRecruiters endpoint: GET /interview/templates/job-applications/{applicationId} from interview-templates.json.",
                'parameters' => [
                    "application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "The job application id",
                    ],
                ],
            ],
            "smartrecruiters_offers_candidates_offers_all" => [
                'class' => SmartRecruitersOffersCandidatesOffersAll::class,
                'name' => "Get candidate's offers",
                'description' => "Get candidate's offers\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/offers from offers-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                ],
            ],
            "smartrecruiters_offers_candidates_offers_get" => [
                'class' => SmartRecruitersOffersCandidatesOffersGet::class,
                'name' => "Get candidate's offer",
                'description' => "Get candidate's offer\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/offers/{offerId} from offers-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "offer_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a Offer",
                    ],
                ],
            ],
            "smartrecruiters_offers_candidates_offers_approvals_latest" => [
                'class' => SmartRecruitersOffersCandidatesOffersApprovalsLatest::class,
                'name' => "Get latest approval request for candidate's offer",
                'description' => "Get latest approval request for candidate's offer\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/jobs/{jobId}/offers/{offerId}/approvals/latest from offers-api.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "candidate identifier",
                    ],
                    "job_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "job identifier",
                    ],
                    "offer_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a Offer",
                    ],
                ],
            ],
            "smartrecruiters_offers_candidates_offers_find" => [
                'class' => SmartRecruitersOffersCandidatesOffersFind::class,
                'name' => "Search offers",
                'description' => "Search offers\n\nOfficial SmartRecruiters endpoint: GET /offers from offers-api.json.",
                'parameters' => [
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return. max value is 100",
                    ],
                    "offset" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to skip while processing result",
                    ],
                    "created_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the offer creation time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                    "created_before" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "ISO8601-formatted time boundaries for the offer creation time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                    "age" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "word-based offer age; when age is specified createdAfter and createdBefore are ignored, Examples: 10 days, 7 hours, 1 week, etc.",
                    ],
                    "status" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "CREATED",
                                "PENDING_APPROVAL",
                                "APPROVED",
                                "NOT_APPROVED",
                                "PENDING_ACCEPTANCE",
                                "ACCEPTED",
                                "NOT_ACCEPTED",
                                "ABANDONED",
                            ],
                        ],
                        "required" => false,
                        "description" => "offer states that need to be included in the results; by default all states are included",
                    ],
                ],
            ],
            "smartrecruiters_offers_offers_documents_get_documents_list" => [
                'class' => SmartRecruitersOffersOffersDocumentsGetDocumentsList::class,
                'name' => "Get a list of documents related to sent offer.",
                'description' => "Get a list of documents related to sent offer.\n\nOfficial SmartRecruiters endpoint: GET /offers/{offerId}/documents from offers-api.json.",
                'parameters' => [
                    "offer_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of an offer.",
                    ],
                ],
            ],
            "smartrecruiters_offers_offers_documents_get_document" => [
                'class' => SmartRecruitersOffersOffersDocumentsGetDocument::class,
                'name' => "Get a given document in a given sent offer",
                'description' => "Get a given document in a given sent offer\n\nOfficial SmartRecruiters endpoint: GET /offers/{offerId}/documents/{documentId} from offers-api.json.",
                'parameters' => [
                    "offer_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of an offer.",
                    ],
                    "document_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a document.",
                    ],
                ],
            ],
            "smartrecruiters_partners_public_get_configs" => [
                'class' => SmartRecruitersPartnersPublicGetConfigs::class,
                'name' => "Fetch list of vendor configs",
                'description' => "Fetch list of vendor configs\n\nOfficial SmartRecruiters endpoint: GET /configs from partners-public-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_partners_public_add_config" => [
                'class' => SmartRecruitersPartnersPublicAddConfig::class,
                'name' => "Add new config",
                'description' => "Add new config\n\nOfficial SmartRecruiters endpoint: POST /configs from partners-public-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Config object that needs to contain Id and Value set. Please see the Model Schema on the right.",
                    ],
                ],
            ],
            "smartrecruiters_partners_public_get_config" => [
                'class' => SmartRecruitersPartnersPublicGetConfig::class,
                'name' => "Get config for vendor",
                'description' => "Get config for vendor\n\nOfficial SmartRecruiters endpoint: GET /configs/{configId} from partners-public-api.json.",
                'parameters' => [
                    "config_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "unique id of a config entry",
                    ],
                ],
            ],
            "smartrecruiters_partners_public_update_config" => [
                'class' => SmartRecruitersPartnersPublicUpdateConfig::class,
                'name' => "Update config",
                'description' => "Update config\n\nOfficial SmartRecruiters endpoint: POST /configs/{configId} from partners-public-api.json.",
                'parameters' => [
                    "config_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "unique id of a config entry",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Config object that needs to contain Id and Value set. Please see the Model Schema on the right.",
                    ],
                ],
            ],
            "smartrecruiters_partners_public_search_offers" => [
                'class' => SmartRecruitersPartnersPublicSearchOffers::class,
                'name' => "Search offers by criteria",
                'description' => "Search offers by criteria\n\nOfficial SmartRecruiters endpoint: GET /offers from partners-public-api.json.",
                'parameters' => [
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of offers to return. max number of offers returned by single call is 100",
                    ],
                    "offset" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of offers to skip while processing result",
                    ],
                    "status" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "offer status; available values are: INACTIVE, UNDER_REVIEW, ACTIVE, REJECTED",
                    ],
                    "q" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "full text query. will match offers with name and description matching query string",
                    ],
                    "posting_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "id of a job posting; allows getting offer information using Posting Id coming from Job Board API; not relevant for Assessment vendors",
                    ],
                ],
            ],
            "smartrecruiters_posting_v1_list_postings" => [
                'class' => SmartRecruitersPostingV1ListPostings::class,
                'name' => "Lists active postings published by given company",
                'description' => "Lists active postings published by given company\n\nOfficial SmartRecruiters endpoint: GET /v1/companies/{companyIdentifier}/postings from posting-api.json.",
                'parameters' => [
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "Language of translation",
                    ],
                    "company_identifier" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a company",
                    ],
                    "q" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "full-text search query based on a job title, location",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to return. max value is 100",
                    ],
                    "offset" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "number of elements to skip while processing result",
                    ],
                    "destination" => [
                        "type" => "string",
                        "enum" => [
                            "PUBLIC",
                            "INTERNAL",
                            "INTERNAL_OR_PUBLIC",
                        ],
                        "required" => false,
                        "description" => "Filter indicating which postings to return: * **PUBLIC**: response will include ONLY public postings * **INTERNAL**: response will include ONLY internal postings * **INTERNAL_OR_PUBLIC**: response will include internal postings or public postings, but not both for a single job. If a job has both types of postings, only internal postings will be returned. NOTE: when selected, all postings, internal and public, will be treated as internal. Among other things, this means that screening questions will not be displayed, and candidates will be marked with the EMPLOYEE label.",
                    ],
                    "location_type" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "REMOTE",
                                "HYBRID",
                                "ONSITE",
                                "ANY",
                            ],
                        ],
                        "required" => false,
                        "description" => "Filter indicating which postings to return: * **REMOTE**: response will include ONLY postings with remote location type * **HYBRID**: response will include ONLY postings with hybrid location type * **ONSITE**: response will include ONLY postings with onsite location type * **ANY**: response will include ANY location type",
                    ],
                    "country" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "country code filter (part of the location object)",
                    ],
                    "region" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "region filter (part of the location object)",
                    ],
                    "city" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "city filter (part of the location object)",
                    ],
                    "department" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "department filter (department id)",
                    ],
                    "job_ad_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "job ad id filter",
                    ],
                    "language" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "af",
                                "am",
                                "ar",
                                "az",
                                "bg",
                                "bn",
                                "ca",
                                "cs",
                                "cy",
                                "da",
                                "de",
                                "el",
                                "en",
                                "en-GB",
                                "es",
                                "es-MX",
                                "et",
                                "eu",
                                "fa",
                                "fi",
                                "fil",
                                "fr",
                                "fr-CA",
                                "ga",
                                "gl",
                                "gu",
                                "he",
                                "hi",
                                "hr",
                                "hu",
                                "hy",
                                "id",
                                "is",
                                "it",
                                "ja",
                                "ka",
                                "km",
                                "kn",
                                "ko",
                                "lo",
                                "lt",
                                "lv",
                                "ml",
                                "mn",
                                "mr",
                                "ms",
                                "ne",
                                "nl",
                                "no",
                                "pl",
                                "pt",
                                "pt-BR",
                                "ro",
                                "ru",
                                "si",
                                "sk",
                                "sl",
                                "sr",
                                "sv",
                                "sw",
                                "ta",
                                "te",
                                "tr",
                                "uk",
                                "ur",
                                "vi",
                                "zh-CN",
                                "zh-TW",
                                "zu",
                            ],
                        ],
                        "required" => false,
                        "description" => "Job ad language; accepts 2-letter ISO 639-1 language code; multiple codes can be provided, separated by comma (\",\") Exceptions to the language code ISO format: * \"en-GB\" - \"English - English (UK)\" * \"fr-CA\" - \"French - franais (Canada)\" * \"pt-BR\" - \"Portugal - portugus (Brasil)\" * \"pt-PT\" - \"Portugal - portugus (Portugal)\" * \"zh-TW\" - \"Chinese (Traditional) - ()\" * \"zh-CN\" - \"Chinese (Simplified) - ()\"",
                    ],
                    "released_after" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "Released after filter (ISO8601-formatted) Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
                    ],
                    "custom_field" => [
                        "type" => "object",
                        "required" => false,
                        "description" => "Filters postings by custom fields. Multiple custom field values can be provided, separated by comma (\",\"). Format: custom_field.CUSTOM_FIELD_ID=CUSTOM_FIELD_VALUE1_ID,CUSTOM_FIELD_VALUE2_ID",
                    ],
                ],
            ],
            "smartrecruiters_posting_v1_get_posting" => [
                'class' => SmartRecruitersPostingV1GetPosting::class,
                'name' => "Get posting by posting id or uuid for given company",
                'description' => "Get posting by posting id or uuid for given company\n\nOfficial SmartRecruiters endpoint: GET /v1/companies/{companyIdentifier}/postings/{postingId} from posting-api.json.",
                'parameters' => [
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "Language of translation",
                    ],
                    "company_identifier" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a company",
                    ],
                    "posting_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Posting identifier or uuid",
                    ],
                    "source_type_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "sourceTypeId can be retrieved using endpoint. Used together with **sourceId** and **sourceSubTypeId** to add source tracking parameter to **applyUrl**.",
                    ],
                    "source_sub_type_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "sourceSubTypeId can be retrieved using endpoint. Used together with **sourceId** and **sourceTypeId** to add source tracking parameter to **applyUrl**.",
                    ],
                    "source_id" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "sourceId can be retrieved using endpoint. Used together with **sourceTypeId** and **sourceSubTypeId** to add source tracking parameter to **applyUrl**.",
                    ],
                ],
            ],
            "smartrecruiters_posting_v1_list_departments" => [
                'class' => SmartRecruitersPostingV1ListDepartments::class,
                'name' => "List departments for given company",
                'description' => "List departments for given company\n\nOfficial SmartRecruiters endpoint: GET /v1/companies/{companyIdentifier}/departments from posting-api.json.",
                'parameters' => [
                    "accept_language" => [
                        "type" => "string",
                        "enum" => [
                            "af",
                            "am",
                            "ar",
                            "az",
                            "bg",
                            "bn",
                            "ca",
                            "cs",
                            "cy",
                            "da",
                            "de",
                            "el",
                            "en",
                            "en-GB",
                            "es",
                            "es-MX",
                            "et",
                            "eu",
                            "fa",
                            "fi",
                            "fil",
                            "fr",
                            "fr-CA",
                            "ga",
                            "gl",
                            "gu",
                            "he",
                            "hi",
                            "hr",
                            "hu",
                            "hy",
                            "id",
                            "is",
                            "it",
                            "ja",
                            "ka",
                            "km",
                            "kn",
                            "ko",
                            "lo",
                            "lt",
                            "lv",
                            "ml",
                            "mn",
                            "mr",
                            "ms",
                            "ne",
                            "nl",
                            "no",
                            "pl",
                            "pt",
                            "pt-BR",
                            "ro",
                            "ru",
                            "si",
                            "sk",
                            "sl",
                            "sr",
                            "sv",
                            "sw",
                            "ta",
                            "te",
                            "tr",
                            "uk",
                            "ur",
                            "vi",
                            "zh-CN",
                            "zh-TW",
                            "zu",
                        ],
                        "required" => false,
                        "description" => "Language of translation",
                    ],
                    "company_identifier" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "Identifier of a company",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_get_self_scheduled_interview" => [
                'class' => SmartRecruitersSelfSchedulingGetSelfScheduledInterview::class,
                'name' => "Returns self-scheduled interview",
                'description' => "Returns self-scheduled interview\n\nOfficial SmartRecruiters endpoint: GET /self-schedules/{id}/application/{applicationUuid}/interview from self-scheduling.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                    "application_uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `applicationUuid`.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_update_self_schedule_interview" => [
                'class' => SmartRecruitersSelfSchedulingUpdateSelfScheduleInterview::class,
                'name' => "Update a self schedule interview",
                'description' => "Update a self schedule interview\n\nOfficial SmartRecruiters endpoint: PUT /self-schedules/{id}/application/{applicationUuid}/interview from self-scheduling.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                    "application_uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `applicationUuid`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Update a self schedule interview.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_create_self_schedule_interview" => [
                'class' => SmartRecruitersSelfSchedulingCreateSelfScheduleInterview::class,
                'name' => "Create a self schedule interview",
                'description' => "Create a self schedule interview\n\nOfficial SmartRecruiters endpoint: POST /self-schedules/{id}/application/{applicationUuid}/interview from self-scheduling.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                    "application_uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `applicationUuid`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Create a self schedule interview.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_automated_self_scheduling" => [
                'class' => SmartRecruitersSelfSchedulingAutomatedSelfScheduling::class,
                'name' => "Creates automated self schedule.",
                'description' => "Creates automated self schedule.\n\nOfficial SmartRecruiters endpoint: POST /automated-self-schedules from self-scheduling.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Creates automated self schedule..",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_get_automated_schedules_available_slots_count_by_interviewer_with_roles" => [
                'class' => SmartRecruitersSelfSchedulingGetAutomatedSchedulesAvailableSlotsCountByInterviewerWithRoles::class,
                'name' => "Returns the automated schedule available slots count based on interviewers availability and specified date params.",
                'description' => "Returns the automated schedule available slots count based on interviewers availability and specified date params.\n\nOfficial SmartRecruiters endpoint: POST /automated-self-schedules/{scheduleType}/application/{applicationUuid}/slots/count/by-role from self-scheduling.json.",
                'parameters' => [
                    "schedule_type" => [
                        "type" => "string",
                        "enum" => [
                            "INDIVIDUAL",
                            "GROUP",
                        ],
                        "required" => true,
                        "description" => "path parameter `scheduleType`.",
                    ],
                    "application_uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `applicationUuid`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Returns the automated schedule available slots count based on interviewers availability and specified date params..",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_update_self_schedule_invite" => [
                'class' => SmartRecruitersSelfSchedulingUpdateSelfScheduleInvite::class,
                'name' => "Requests invite update for automated self-schedule",
                'description' => "Requests invite update for automated self-schedule\n\nOfficial SmartRecruiters endpoint: POST /automated-self-schedules/update-invite from self-scheduling.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Requests invite update for automated self-schedule.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_request_self_reschedule" => [
                'class' => SmartRecruitersSelfSchedulingRequestSelfReschedule::class,
                'name' => "Requests self reschedule for candidate for automated self-schedule.",
                'description' => "Requests self reschedule for candidate for automated self-schedule.\n\nOfficial SmartRecruiters endpoint: POST /automated-self-schedules/reschedule from self-scheduling.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Requests self reschedule for candidate for automated self-schedule..",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_search_self_schedules" => [
                'class' => SmartRecruitersSelfSchedulingSearchSelfSchedules::class,
                'name' => "Search for a self-scheduling instances",
                'description' => "Search for a self-scheduling instances\n\nOfficial SmartRecruiters endpoint: GET /self-schedules from self-scheduling.json.",
                'parameters' => [
                    "with_interviews" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "If set - filters out self schedules with interviews created/not created",
                    ],
                    "application_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "query parameter `applicationId`.",
                    ],
                    "limit" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "query parameter `limit`.",
                    ],
                    "offset" => [
                        "type" => "integer",
                        "required" => false,
                        "description" => "query parameter `offset`.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_get_self_schedule" => [
                'class' => SmartRecruitersSelfSchedulingGetSelfSchedule::class,
                'name' => "Gets self schedule by id",
                'description' => "Gets self schedule by id\n\nOfficial SmartRecruiters endpoint: GET /self-schedules/{id} from self-scheduling.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_cancel_self_schedule" => [
                'class' => SmartRecruitersSelfSchedulingCancelSelfSchedule::class,
                'name' => "Cancels self schedule",
                'description' => "Cancels self schedule\n\nOfficial SmartRecruiters endpoint: DELETE /self-schedules/{id} from self-scheduling.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_get_application_self_schedule" => [
                'class' => SmartRecruitersSelfSchedulingGetApplicationSelfSchedule::class,
                'name' => "Retrieve application-related details for a self-scheduling instance",
                'description' => "Retrieve application-related details for a self-scheduling instance\n\nOfficial SmartRecruiters endpoint: GET /self-schedules/{id}/application/{applicationUuid} from self-scheduling.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                    "application_uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `applicationUuid`.",
                    ],
                ],
            ],
            "smartrecruiters_self_scheduling_available_slots_for_application" => [
                'class' => SmartRecruitersSelfSchedulingAvailableSlotsForApplication::class,
                'name' => "Get self-schedule slots for application",
                'description' => "Get self-schedule slots for application\n\nOfficial SmartRecruiters endpoint: GET /self-schedules/{id}/application/{applicationUuid}/slots from self-scheduling.json.",
                'parameters' => [
                    "id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `id`.",
                    ],
                    "application_uuid" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `applicationUuid`.",
                    ],
                ],
            ],
            "smartrecruiters_url_shortener_public_shorten" => [
                'class' => SmartRecruitersUrlShortenerPublicShorten::class,
                'name' => "Shorten URL",
                'description' => "Shorten URL\n\nOfficial SmartRecruiters endpoint: POST /shorten from url-shortener.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters url-shortener.json schema for Shorten URL.",
                    ],
                ],
            ],
            "smartrecruiters_notifications_get_employee_preferences" => [
                'class' => SmartRecruitersNotificationsGetEmployeePreferences::class,
                'name' => "Get list of employee notifications preferences for a specific channel.",
                'description' => "Get list of employee notifications preferences for a specific channel.\n\nOfficial SmartRecruiters endpoint: GET /employee-preferences from notifications-api.json.",
                'parameters' => [
                    "channel" => [
                        "type" => "string",
                        "enum" => [
                            "SLACK",
                            "TEAMS",
                            "EMAIL",
                        ],
                        "required" => true,
                        "description" => "query parameter `channel`.",
                    ],
                ],
            ],
            "smartrecruiters_notifications_save_employee_preferences" => [
                'class' => SmartRecruitersNotificationsSaveEmployeePreferences::class,
                'name' => "Save employee notifications preferences.",
                'description' => "Save employee notifications preferences.\n\nOfficial SmartRecruiters endpoint: POST /employee-preferences from notifications-api.json.",
                'parameters' => [
                    "channel" => [
                        "type" => "string",
                        "enum" => [
                            "SLACK",
                            "TEAMS",
                            "EMAIL",
                        ],
                        "required" => true,
                        "description" => "query parameter `channel`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters notifications-api.json schema for Save employee notifications preferences..",
                    ],
                ],
            ],
            "smartrecruiters_notifications_upsert_employee_preferences" => [
                'class' => SmartRecruitersNotificationsUpsertEmployeePreferences::class,
                'name' => "Activate or deactivate employee notification preferences for hiring roles and notification channels in bulk.",
                'description' => "Activate or deactivate employee notification preferences for hiring roles and notification channels in bulk.\n\nOfficial SmartRecruiters endpoint: PATCH /employee-preferences from notifications-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters notifications-api.json schema for Activate or deactivate employee notification preferences for hiring roles and notification channels in bulk..",
                    ],
                ],
            ],
            "smartrecruiters_notifications_find_global_preferences" => [
                'class' => SmartRecruitersNotificationsFindGlobalPreferences::class,
                'name' => "Find global notification preferences.",
                'description' => "Find global notification preferences.\n\nOfficial SmartRecruiters endpoint: GET /global-preferences from notifications-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_notifications_upsert_global_preferences" => [
                'class' => SmartRecruitersNotificationsUpsertGlobalPreferences::class,
                'name' => "Activate or deactivate global notification preferences for hiring roles and notification channels in bulk.",
                'description' => "Activate or deactivate global notification preferences for hiring roles and notification channels in bulk.\n\nOfficial SmartRecruiters endpoint: PATCH /global-preferences from notifications-api.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters notifications-api.json schema for Activate or deactivate global notification preferences for hiring roles and notification channels in bulk..",
                    ],
                ],
            ],
            "smartrecruiters_notifications_update_employee_preferences" => [
                'class' => SmartRecruitersNotificationsUpdateEmployeePreferences::class,
                'name' => "Update employee notifications preferences.",
                'description' => "Update employee notifications preferences.\n\nOfficial SmartRecruiters endpoint: PATCH /employee-preferences/preferences/{preferenceId} from notifications-api.json.",
                'parameters' => [
                    "preference_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `preferenceId`.",
                    ],
                    "enabled" => [
                        "type" => "boolean",
                        "required" => false,
                        "description" => "query parameter `enabled`.",
                    ],
                ],
            ],
            "smartrecruiters_notifications_find_all_notification_types" => [
                'class' => SmartRecruitersNotificationsFindAllNotificationTypes::class,
                'name' => "Find all supported notification types along with applicable roles and channels they can be delivered.",
                'description' => "Find all supported notification types along with applicable roles and channels they can be delivered.\n\nOfficial SmartRecruiters endpoint: GET /notification-types from notifications-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_notifications_get_all_employee_preferences" => [
                'class' => SmartRecruitersNotificationsGetAllEmployeePreferences::class,
                'name' => "Get list of all employee notifications preferences.",
                'description' => "Get list of all employee notifications preferences.\n\nOfficial SmartRecruiters endpoint: GET /employee-preferences/all from notifications-api.json.",
                'parameters' => [],
            ],
            "smartrecruiters_email_company_get_message_template" => [
                'class' => SmartRecruitersEmailCompanyGetMessageTemplate::class,
                'name' => "Get a message template by id.",
                'description' => "Get a message template by id.\n\nOfficial SmartRecruiters endpoint: GET /message-templates/{messageTemplateId} from email-company.json.",
                'parameters' => [
                    "message_template_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `messageTemplateId`.",
                    ],
                ],
            ],
            "smartrecruiters_email_company_update_message_template" => [
                'class' => SmartRecruitersEmailCompanyUpdateMessageTemplate::class,
                'name' => "Update Message Template",
                'description' => "Update Message Template\n\nOfficial SmartRecruiters endpoint: PUT /message-templates/{messageTemplateId} from email-company.json.",
                'parameters' => [
                    "message_template_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `messageTemplateId`.",
                    ],
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters email-company.json schema for Update Message Template.",
                    ],
                ],
            ],
            "smartrecruiters_email_company_remove_message_template" => [
                'class' => SmartRecruitersEmailCompanyRemoveMessageTemplate::class,
                'name' => "Remove a message template by id.",
                'description' => "Remove a message template by id.\n\nOfficial SmartRecruiters endpoint: DELETE /message-templates/{messageTemplateId} from email-company.json.",
                'parameters' => [
                    "message_template_id" => [
                        "type" => "string",
                        "required" => true,
                        "description" => "path parameter `messageTemplateId`.",
                    ],
                ],
            ],
            "smartrecruiters_email_company_get_message_templates" => [
                'class' => SmartRecruitersEmailCompanyGetMessageTemplates::class,
                'name' => "Get Message Templates",
                'description' => "Get Message Templates\n\nOfficial SmartRecruiters endpoint: GET /message-templates from email-company.json.",
                'parameters' => [
                    "type" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "INTERVIEW_INVITATION",
                                "JOB_OFFER",
                                "REJECTION",
                                "NORMAL_MESSAGE",
                                "NEW_APPLICANT_AUTO_RESPOND",
                                "NEW_INTERNAL_APPLICANT_AUTO_RESPOND",
                                "CAMPAIGN",
                                "SELF_SCHEDULE",
                                "NORMAL_PROSPECT_MESSAGE",
                                "WORKFLOWS_EMAIL_TO_EMPLOYEE",
                                "WORKFLOWS_EMAIL_TO_CANDIDATE",
                                "GROUP_EVENT_INVITATION",
                                "GROUP_EVENT_REMINDER",
                                "SESSION_SELF_SCHEDULE_CONFIRMATION",
                                "SESSION_MANUAL_SCHEDULE_CONFIRMATION",
                                "GROUP_EVENT_CANCELLED",
                                "SESSION_MANUAL_RESCHEDULE_CONFIRMATION",
                                "SESSION_UPDATE",
                                "AUTOMATED_SELF_SCHEDULE_INVITATION",
                                "INTERVIEW_INVITATION_CANCEL_NOTIFICATION",
                                "SELF_SCHEDULE_CANCEL_NOTIFICATION",
                                "INTERVIEW_REMINDER",
                                "INVITATION_TO_SELF_SCHEDULE_UPDATED",
                                "REQUEST_SELF_RESCHEDULE",
                                "AUTOMATED_GROUP_INTERVIEW_INVITATION",
                                "AUTOMATED_GROUP_INTERVIEW_REMINDER",
                                "AUTOMATED_GROUP_INTERVIEW_CONFIRMATION",
                                "GROUP_EVENT_CONFIRMATION",
                            ],
                        ],
                        "required" => false,
                        "description" => "query parameter `type`.",
                    ],
                    "channel" => [
                        "type" => "array",
                        "items" => [
                            "type" => "string",
                            "enum" => [
                                "EMAIL",
                                "SMS_WHATSAPP",
                            ],
                        ],
                        "required" => false,
                        "description" => "query parameter `channel`.",
                    ],
                    "name" => [
                        "type" => "string",
                        "required" => false,
                        "description" => "query parameter `name`.",
                    ],
                ],
            ],
            "smartrecruiters_email_company_create_message_template" => [
                'class' => SmartRecruitersEmailCompanyCreateMessageTemplate::class,
                'name' => "Create Message Template",
                'description' => "Create Message Template\n\nOfficial SmartRecruiters endpoint: POST /message-templates from email-company.json.",
                'parameters' => [
                    "body" => [
                        "type" => "object",
                        "required" => true,
                        "description" => "Request body matching the official SmartRecruiters email-company.json schema for Create Message Template.",
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): SmartRecruitersService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new SmartRecruitersService(apiKey: $creds->get('smartrecruiters', 'api_key', '', $account), accessToken: $creds->get('smartrecruiters', 'access_token', '', $account), clientId: $creds->get('smartrecruiters', 'client_id', '', $account), clientSecret: $creds->get('smartrecruiters', 'client_secret', '', $account), baseUrl: $creds->get('smartrecruiters', 'url', 'https://api.smartrecruiters.com', $account), tokenUrl: $creds->get('smartrecruiters', 'token_url', 'https://api.smartrecruiters.com/identity/oauth/token', $account));
        }

        return app(SmartRecruitersService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/smartrecruiters.md'; }
    public function isIntegration(): bool { return true; }
}
