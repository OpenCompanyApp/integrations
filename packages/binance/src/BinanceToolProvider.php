<?php

namespace OpenCompany\Integrations\Binance;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Ping;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Time;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Exchangeinfo;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Depth;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Trades;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Historicaltrades;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Aggtrades;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Klines;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Uiklines;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Avgprice;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Ticker24hr;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3TickerTradingday;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3TickerPrice;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3TickerBookticker;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Ticker;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3OrderTest;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Order;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3Order;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteApiV3Order;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3OrderCancelreplace;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Openorders;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteApiV3Openorders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Allorders;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3OrderlistOco;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3OrderlistOto;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3OrderlistOtoco;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Orderlist;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteApiV3Orderlist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Allorderlist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Openorderlist;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3SorOrder;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3SorOrderTest;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Account;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Mytrades;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3RatelimitOrder;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Mypreventedmatches;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Myallocations;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3AccountCommission;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginBorrowRepay;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginBorrowRepay;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginTransfer;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginAllassets;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginAllpairs;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginPriceindex;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginOrder;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginOrder;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1MarginOrder;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginInteresthistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginForceliquidationrec;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginOpenorders;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1MarginOpenorders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginAllorders;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginOrderOco;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginOrderlist;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1MarginOrderlist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginAllorderlist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginOpenorderlist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginMytrades;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginMaxborrowable;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginMaxtransferable;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginTradecoeff;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginIsolatedAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1MarginIsolatedAccount;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginIsolatedAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginIsolatedAccountlimit;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginIsolatedAllpairs;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1Bnbburn;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1Bnbburn;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginInterestratehistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginCrossmargindata;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginIsolatedmargindata;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginIsolatedmargintier;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginRatelimitOrder;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginCrossmargincollateralratio;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginExchangeSmallLiability;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginExchangeSmallLiabilityHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginNextHourlyInterestRate;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginCapitalFlow;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginDelistSchedule;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginAvailableInventory;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginManualLiquidation;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginOrderOto;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginOrderOtoco;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MarginMaxLeverage;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MarginLeveragebracket;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SystemStatus;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalConfigGetall;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1Accountsnapshot;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AccountDisablefastwithdrawswitch;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AccountEnablefastwithdrawswitch;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1CapitalWithdrawApply;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalDepositHisrec;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalWithdrawHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalDepositAddress;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AccountStatus;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AccountApitradingstatus;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetDribblet;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AssetDustBtc;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AssetDust;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetAssetdividend;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetAssetdetail;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetTradefee;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetTransfer;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AssetTransfer;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AssetGetFundingAsset;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV3AssetGetuserasset;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AssetConvertTransfer;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetConvertTransferQuerybypage;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetLedgerTransferCloudMiningQuerybypage;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AccountApirestrictions;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalContractConvertibleCoins;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1CapitalContractConvertibleCoins;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountVirtualsubaccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountSubTransferHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountFuturesInternaltransfer;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountFuturesInternaltransfer;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV3SubAccountAssets;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountSpotsummary;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalDepositSubaddress;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalDepositSubhisrec;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1CapitalDepositCreditApply;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetWalletBalance;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AssetCustodyTransferHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalDepositAddressList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SpotDelistSchedule;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CapitalWithdrawAddressList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AccountInfo;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountStatus;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountMarginEnable;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountMarginAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountMarginAccountsummary;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountFuturesEnable;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountFuturesAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountFuturesAccountsummary;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountFuturesPositionrisk;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountFuturesTransfer;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountMarginTransfer;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountTransferSubtosub;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountTransferSubtomaster;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountTransferSubuserhistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountUniversaltransfer;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountUniversaltransfer;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2SubAccountFuturesAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2SubAccountFuturesAccountsummary;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2SubAccountFuturesPositionrisk;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountBlvtEnable;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1ManagedSubaccountDeposit;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountAsset;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1ManagedSubaccountWithdraw;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountAccountsnapshot;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountQuerytranslogforinvestor;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountQuerytranslogfortradeparent;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountFetchFutureAsset;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountMarginasset;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountInfo;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountDepositAddress;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ManagedSubaccountQueryTransLog;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountSubaccountapiIprestriction;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1SubAccountSubaccountapiIprestrictionIplist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SubAccountTransactionStatistics;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SubAccountEoptionsEnable;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV2SubAccountSubaccountapiIprestriction;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV4SubAccountAssets;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3Userdatastream;
use OpenCompany\Integrations\Binance\Tools\BinancePutApiV3Userdatastream;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteApiV3Userdatastream;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1Userdatastream;
use OpenCompany\Integrations\Binance\Tools\BinancePutSapiV1Userdatastream;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1Userdatastream;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1UserdatastreamIsolated;
use OpenCompany\Integrations\Binance\Tools\BinancePutSapiV1UserdatastreamIsolated;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1UserdatastreamIsolated;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1FiatOrders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1FiatPayments;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingProjectList;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LendingCustomizedfixedPurchase;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingProjectPositionList;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LendingPositionchanged;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningPubAlgolist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningPubCoinlist;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningWorkerDetail;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningWorkerList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningPaymentList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningPaymentOther;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningHashTransferConfigDetailsList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningHashTransferProfitDetails;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MiningHashTransferConfig;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1MiningHashTransferConfigCancel;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningStatisticsUserStatus;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningStatisticsUserList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1MiningPaymentUid;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1FuturesTransfer;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1FuturesTransfer;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1FuturesHistdatalink;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AlgoFuturesNewordervp;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AlgoFuturesNewordertwap;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1AlgoFuturesOrder;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AlgoFuturesOpenorders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AlgoFuturesHistoricalorders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AlgoFuturesSuborders;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1AlgoSpotNewordertwap;
use OpenCompany\Integrations\Binance\Tools\BinanceDeleteSapiV1AlgoSpotOrder;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AlgoSpotOpenorders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AlgoSpotHistoricalorders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1AlgoSpotSuborders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PortfolioAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PortfolioCollateralrate;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2PortfolioCollateralrate;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PortfolioPmloan;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1PortfolioRepay;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PortfolioInterestHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PortfolioAssetIndexPrice;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1PortfolioAutoCollection;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1PortfolioBnbTransfer;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1PortfolioRepayFuturesSwitch;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PortfolioRepayFuturesSwitch;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1PortfolioRepayFuturesNegativeBalance;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PortfolioMarginAssetLeverage;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1PortfolioAssetCollection;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1BlvtTokeninfo;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1BlvtSubscribe;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1BlvtSubscribeRecord;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1BlvtRedeem;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1BlvtRedeemRecord;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1BlvtUserlimit;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1C2cOrdermatchListuserorderhistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanVipOngoingOrders;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LoanVipRepay;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanVipRepayHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanVipCollateralAccount;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LoanVipBorrow;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanVipLoanableData;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanVipCollateralData;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanVipRequestData;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanVipRequestInterestrate;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LoanVipRenew;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanIncome;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LoanBorrow;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanBorrowHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanOngoingOrders;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LoanRepay;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanRepayHistory;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LoanAdjustLtv;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanLtvAdjustmentHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanLoanableData;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanCollateralData;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LoanRepayCollateralRate;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LoanCustomizeMarginCall;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV2LoanFlexibleBorrow;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2LoanFlexibleOngoingOrders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2LoanFlexibleBorrowHistory;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV2LoanFlexibleRepay;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2LoanFlexibleRepayHistory;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV2LoanFlexibleAdjustLtv;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2LoanFlexibleLtvAdjustmentHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2LoanFlexibleLoanableData;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2LoanFlexibleCollateralData;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1PayTransactions;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ConvertExchangeinfo;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ConvertAssetinfo;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1ConvertGetquote;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1ConvertAcceptquote;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ConvertOrderstatus;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1ConvertLimitPlaceorder;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1ConvertLimitCancelorder;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ConvertLimitQueryopenorders;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1ConvertTradeflow;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1RebateTaxquery;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1NftHistoryTransactions;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1NftHistoryDeposit;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1NftHistoryWithdraw;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1NftUserGetasset;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1GiftcardCreatecode;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1GiftcardRedeemcode;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1GiftcardVerify;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1GiftcardCryptographyRsaPublicKey;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1GiftcardBuycode;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1GiftcardBuycodeTokenLimit;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestTargetAssetList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestTargetAssetRoiList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestAllAsset;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestSourceAssetList;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LendingAutoInvestPlanAdd;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LendingAutoInvestPlanEdit;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LendingAutoInvestPlanEditStatus;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestPlanList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestPlanId;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestHistoryList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestIndexInfo;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestIndexUserSummary;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LendingAutoInvestOneOff;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestOneOffStatus;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1LendingAutoInvestRedeem;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestRedeemHistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1LendingAutoInvestRebalanceHistory;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV2EthStakingEthStake;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1EthStakingEthRedeem;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingEthHistoryStakinghistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingEthHistoryRedemptionhistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingEthHistoryRewardshistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingEthQuota;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingEthHistoryRatehistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV2EthStakingAccount;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1EthStakingWbethWrap;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingWbethHistoryWraphistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingWbethHistoryUnwraphistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1EthStakingEthHistoryWbethrewardshistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CopytradingFuturesUserstatus;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1CopytradingFuturesLeadsymbol;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexibleList;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedList;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SimpleEarnFlexibleSubscribe;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SimpleEarnLockedSubscribe;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SimpleEarnFlexibleRedeem;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SimpleEarnLockedRedeem;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexiblePosition;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedPosition;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnAccount;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexibleHistorySubscriptionrecord;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedHistorySubscriptionrecord;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexibleHistoryRedemptionrecord;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedHistoryRedemptionrecord;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexibleHistoryRewardsrecord;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedHistoryRewardsrecord;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SimpleEarnFlexibleSetautosubscribe;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1SimpleEarnLockedSetautosubscribe;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexiblePersonalleftquota;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedPersonalleftquota;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexibleSubscriptionpreview;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedSubscriptionpreview;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnLockedSetredeemoption;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexibleHistoryRatehistory;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1SimpleEarnFlexibleHistoryCollateralrecord;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1DciProductList;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1DciProductSubscribe;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1DciProductPositions;
use OpenCompany\Integrations\Binance\Tools\BinanceGetSapiV1DciProductAccounts;
use OpenCompany\Integrations\Binance\Tools\BinancePostSapiV1DciProductAutoCompoundEditStatus;

/**
 * Tool catalog and configuration metadata for Binance.
 *
 * Exposes the official Binance Spot OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific API keys for multi-account hosts.
 */
class BinanceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key_hmac', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['api_key', 'api_secret'], 'notes' => ['Public endpoints do not require credentials. API-key endpoints send X-MBX-APIKEY. Signed endpoints auto-fill timestamp and HMAC SHA256 signature using api_secret.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'binance'; }
    public function appMeta(): array { return ['label' => 'Binance', 'description' => 'Spot market data, trading, account, margin, wallet, sub-account, savings, staking, mining, convert, fiat, NFT, loan, and broker APIs', 'icon' => 'ph:currency-btc', 'logo' => 'ph:currency-btc']; }
    public function integrationMeta(): array { return ['name' => 'Binance', 'description' => 'Manage Binance Spot public market data, orders, account data, margin, wallet, sub-accounts, savings, staking, mining, convert, fiat, NFT, loan, broker, and related SAPI endpoints.', 'icon' => 'ph:currency-btc', 'logo' => 'ph:currency-btc', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://binance.github.io/binance-api-swagger/']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Binance API key', 'hint' => 'Sent as X-MBX-APIKEY for API-key and signed endpoints.', 'required' => false], ['key' => 'api_secret', 'type' => 'secret', 'label' => 'API Secret', 'placeholder' => 'Binance API secret', 'hint' => 'Used locally to sign timestamped endpoints with HMAC SHA256.', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.binance.com', 'default' => 'https://api.binance.com']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.binance.com'), '/');
        $apiKey = (string) ($config['api_key'] ?? '');
        $apiSecret = (string) ($config['api_secret'] ?? '');

        try {
            if ($apiKey !== '' && $apiSecret !== '') {
                $query = ['timestamp' => (int) floor(microtime(true) * 1000)];
                $query['signature'] = hash_hmac('sha256', 'timestamp=' . $query['timestamp'], $apiSecret);
                $response = Http::withHeaders(['Accept' => 'application/json', 'X-MBX-APIKEY' => $apiKey])->timeout(10)->get($baseUrl . '/api/v3/account', $query);
            } else {
                $response = Http::withHeaders(['Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/api/v3/ping');
            }
            if (!$response->successful()) { return ['success' => false, 'error' => 'Binance API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to Binance at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'api_secret' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'binance_get_api_v3_ping' => [
                'class' => BinanceGetApiV3Ping::class,
                'name' => 'Test Connectivity',
                'description' => 'Test Connectivity

Test connectivity to the Rest API. Weight(IP): 1

Official Binance Spot endpoint: GET /api/v3/ping.',
                'parameters' => [],
            ],
            'binance_get_api_v3_time' => [
                'class' => BinanceGetApiV3Time::class,
                'name' => 'Check Server Time',
                'description' => 'Check Server Time

Test connectivity to the Rest API and get the current server time. Weight(IP): 1

Official Binance Spot endpoint: GET /api/v3/time.',
                'parameters' => [],
            ],
            'binance_get_api_v3_exchangeinfo' => [
                'class' => BinanceGetApiV3Exchangeinfo::class,
                'name' => 'Exchange Information',
                'description' => 'Exchange Information

Current exchange trading rules and symbol information - If any symbol provided in either symbol or symbols do not exist, the endpoint will throw an error. - All parameters are optional. - permissions can support single or multiple values (e.g. SPOT, ["MARGIN","LEVERAGED"]) - If permissions parameter not provided, the default values will be ["SPOT","MARGIN","LEVERAGED"]. - To display all permissions you need to specify them explicitly. (e.g. SPOT, MARGIN,...) Examples of Symbol Permissions Interpretation from the Response: - [["A","B"]] means you may place an order if your account has either permission "A" or permission "B". - [["A"],["B"]] means you can place an order if your account has permission "A" and permission "B". - [["A"],["B","C"]] means you can place an order if your account has permission "A" and permission "B" or permission "C". (Inclusive or is applied here, not exclusive or, so your account may have both permission "B" and permission "C".) Weight(IP): 10

Official Binance Spot endpoint: GET /api/v3/exchangeInfo.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'symbols' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `symbols`.',
                    ],
                    'permissions' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `permissions`.',
                    ],
                ],
            ],
            'binance_get_api_v3_depth' => [
                'class' => BinanceGetApiV3Depth::class,
                'name' => 'Order Book',
                'description' => 'Order Book

| Limit | Weight(IP) | |---------------------|-------------| | 1-100 | 5 | | 101-500 | 25 | | 501-1000 | 50 | | 1001-5000 | 250 |

Official Binance Spot endpoint: GET /api/v3/depth.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'If limit > 5000, then the response will truncate to 5000',
                    ],
                ],
            ],
            'binance_get_api_v3_trades' => [
                'class' => BinanceGetApiV3Trades::class,
                'name' => 'Recent Trades List',
                'description' => 'Recent Trades List

Get recent trades. Weight(IP): 10

Official Binance Spot endpoint: GET /api/v3/trades.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                ],
            ],
            'binance_get_api_v3_historicaltrades' => [
                'class' => BinanceGetApiV3Historicaltrades::class,
                'name' => 'Old Trade Lookup',
                'description' => 'Old Trade Lookup

Get older market trades. Weight(IP): 10

Official Binance Spot endpoint: GET /api/v3/historicalTrades.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'from_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Trade id to fetch from. Default gets most recent trades.',
                    ],
                ],
            ],
            'binance_get_api_v3_aggtrades' => [
                'class' => BinanceGetApiV3Aggtrades::class,
                'name' => 'Compressed/Aggregate Trades List',
                'description' => 'Compressed/Aggregate Trades List

Get compressed, aggregate trades. Trades that fill at the time, from the same order, with the same price will have the quantity aggregated. - If `fromId`, `startTime`, and `endTime` are not sent, the most recent aggregate trades will be returned. - Note that if a trade has the following values, this was a duplicate aggregate trade and marked as invalid: p = \'0\' // price q = \'0\' // qty f = -1 // ﬁrst_trade_id l = -1 // last_trade_id Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/aggTrades.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'from_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Trade id to fetch from. Default gets most recent trades.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                ],
            ],
            'binance_get_api_v3_klines' => [
                'class' => BinanceGetApiV3Klines::class,
                'name' => 'Kline/Candlestick Data',
                'description' => 'Kline/Candlestick Data

Kline/candlestick bars for a symbol. Klines are uniquely identified by their open time. - If `startTime` and `endTime` are not sent, the most recent klines are returned. Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/klines.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'kline intervals',
                        'enum' => [
                            '1s',
                            '1m',
                            '3m',
                            '5m',
                            '15m',
                            '30m',
                            '1h',
                            '2h',
                            '4h',
                            '6h',
                            '8h',
                            '12h',
                            '1d',
                            '3d',
                            '1w',
                            '1M',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'time_zone' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default: 0 (UTC)',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                ],
            ],
            'binance_get_api_v3_uiklines' => [
                'class' => BinanceGetApiV3Uiklines::class,
                'name' => 'UIKlines',
                'description' => 'UIKlines

The request is similar to klines having the same parameters and response. uiKlines return modified kline data, optimized for presentation of candlestick charts. Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/uiKlines.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'kline intervals',
                        'enum' => [
                            '1s',
                            '1m',
                            '3m',
                            '5m',
                            '15m',
                            '30m',
                            '1h',
                            '2h',
                            '4h',
                            '6h',
                            '8h',
                            '12h',
                            '1d',
                            '3d',
                            '1w',
                            '1M',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'time_zone' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default: 0 (UTC)',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                ],
            ],
            'binance_get_api_v3_avgprice' => [
                'class' => BinanceGetApiV3Avgprice::class,
                'name' => 'Current Average Price',
                'description' => 'Current Average Price

Current average price for a symbol. Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/avgPrice.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                ],
            ],
            'binance_get_api_v3_ticker_24hr' => [
                'class' => BinanceGetApiV3Ticker24hr::class,
                'name' => '24hr Ticker Price Change Statistics',
                'description' => '24hr Ticker Price Change Statistics

24 hour rolling window price change statistics. Careful when accessing this with no symbol. - If the symbol is not sent, tickers for all symbols will be returned in an array. Weight(IP): - `2` for a single symbol; - `80` when the symbol parameter is omitted;

Official Binance Spot endpoint: GET /api/v3/ticker/24hr.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'symbols' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `symbols`.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Supported values: FULL or MINI. If none provided, the default is FULL',
                        'enum' => [
                            'FULL',
                            'MINI',
                        ],
                    ],
                ],
            ],
            'binance_get_api_v3_ticker_tradingday' => [
                'class' => BinanceGetApiV3TickerTradingday::class,
                'name' => 'Trading Day Ticker',
                'description' => 'Trading Day Ticker

Price change statistics for a trading day. Notes: - Supported values for timeZone: - Hours and minutes (e.g. -1:00, 05:45) - Only hours (e.g. 0, 8, 4) Weight: - `4` for each requested symbol. - The weight for this request will cap at `200` once the number of symbols in the request is more than `50`.

Official Binance Spot endpoint: GET /api/v3/ticker/tradingDay.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'symbols' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `symbols`.',
                    ],
                    'time_zone' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default: 0 (UTC)',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Supported values: FULL or MINI. If none provided, the default is FULL',
                        'enum' => [
                            'FULL',
                            'MINI',
                        ],
                    ],
                ],
            ],
            'binance_get_api_v3_ticker_price' => [
                'class' => BinanceGetApiV3TickerPrice::class,
                'name' => 'Symbol Price Ticker',
                'description' => 'Symbol Price Ticker

Latest price for a symbol or symbols. - If the symbol is not sent, prices for all symbols will be returned in an array. Weight(IP): - `2` for a single symbol; - `4` when the symbol parameter is omitted;

Official Binance Spot endpoint: GET /api/v3/ticker/price.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'symbols' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `symbols`.',
                    ],
                ],
            ],
            'binance_get_api_v3_ticker_bookticker' => [
                'class' => BinanceGetApiV3TickerBookticker::class,
                'name' => 'Symbol Order Book Ticker',
                'description' => 'Symbol Order Book Ticker

Best price/qty on the order book for a symbol or symbols. - If the symbol is not sent, bookTickers for all symbols will be returned in an array. Weight(IP): - `2` for a single symbol; - `4` when the symbol parameter is omitted;

Official Binance Spot endpoint: GET /api/v3/ticker/bookTicker.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'symbols' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `symbols`.',
                    ],
                ],
            ],
            'binance_get_api_v3_ticker' => [
                'class' => BinanceGetApiV3Ticker::class,
                'name' => 'Rolling window price change statistics',
                'description' => 'Rolling window price change statistics

The window used to compute statistics is typically slightly wider than requested windowSize. openTime for /api/v3/ticker always starts on a minute, while the closeTime is the current time of the request. As such, the effective window might be up to 1 minute wider than requested. E.g. If the closeTime is 1641287867099 (January 04, 2022 09:17:47:099 UTC) , and the windowSize is 1d. the openTime will be: 1641201420000 (January 3, 2022, 09:17:00 UTC) Weight(IP): 4 for each requested symbol regardless of windowSize. The weight for this request will cap at 200 once the number of symbols in the request is more than 50.

Official Binance Spot endpoint: GET /api/v3/ticker.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'symbols' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `symbols`.',
                    ],
                    'window_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Defaults to 1d if no parameter provided. Supported windowSize values: 1m,2m....59m for minutes 1h, 2h....23h - for hours 1d...7d - for days. Units cannot be combined (e.g. 1d2h is not allowed)',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Supported values: FULL or MINI. If none provided, the default is FULL',
                    ],
                ],
            ],
            'binance_post_api_v3_order_test' => [
                'class' => BinancePostApiV3OrderTest::class,
                'name' => 'Test New Order (TRADE)',
                'description' => 'Test New Order (TRADE)

Test new order creation and signature/recvWindow long. Creates and validates a new order but does not send it into the matching engine. Weight(IP): - Without computeCommissionRates: `1` - With computeCommissionRates: `20`

Official Binance Spot endpoint: POST /api/v3/order/test.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Order type',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order time in force',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Order quantity',
                    ],
                    'quote_order_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Quote quantity',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Order price',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'strategy_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `strategyId`.',
                    ],
                    'strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be less than 1000000.',
                    ],
                    'stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with STOP_LOSS, STOP_LOSS_LIMIT, TAKE_PROFIT, and TAKE_PROFIT_LIMIT orders.',
                    ],
                    'trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with STOP_LOSS, STOP_LOSS_LIMIT, TAKE_PROFIT, and TAKE_PROFIT_LIMIT orders.',
                    ],
                    'iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with LIMIT, STOP_LOSS_LIMIT, and TAKE_PROFIT_LIMIT to create an iceberg order.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON. MARKET and LIMIT order types default to FULL, all other orders default to ACK.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'compute_commission_rates' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Default: false',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_order' => [
                'class' => BinanceGetApiV3Order::class,
                'name' => 'Query Order (USER_DATA)',
                'description' => 'Query Order (USER_DATA)

Check an order\'s status. - Either `orderId` or `origClientOrderId` must be sent. - For some historical orders `cummulativeQuoteQty` will be < 0, meaning the data is not available at this time. Weight(IP): 4

Official Binance Spot endpoint: GET /api/v3/order.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'orig_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order id from client',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_order' => [
                'class' => BinancePostApiV3Order::class,
                'name' => 'New Order (TRADE)',
                'description' => 'New Order (TRADE)

Send in a new order. - `LIMIT_MAKER` are `LIMIT` orders that will be rejected if they would immediately match and trade as a taker. - `STOP_LOSS` and `TAKE_PROFIT` will execute a `MARKET` order when the `stopPrice` is reached. - Any `LIMIT` or `LIMIT_MAKER` type order can be made an iceberg order by sending an `icebergQty`. - Any order with an `icebergQty` MUST have `timeInForce` set to `GTC`. - `MARKET` orders using `quantity` specifies how much a user wants to buy or sell based on the market price. - `MARKET` orders using `quoteOrderQty` specifies the amount the user wants to spend (when buying) or receive (when selling) of the quote asset; the correct quantity will be determined based on the market liquidity and `quoteOrderQty`. - `MARKET` orders using `quoteOrderQty` will not break `LOT_SIZE` filter rules; the order will execute a quantity that will have the notional value as close as possible to `quoteOrderQty`. - same `newClientOrderId` can be accepted only when the previous one

Official Binance Spot endpoint: POST /api/v3/order.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Order type',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order time in force',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Order quantity',
                    ],
                    'quote_order_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Quote quantity',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Order price',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'strategy_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `strategyId`.',
                    ],
                    'strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be less than 1000000.',
                    ],
                    'stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with STOP_LOSS, STOP_LOSS_LIMIT, TAKE_PROFIT, and TAKE_PROFIT_LIMIT orders.',
                    ],
                    'trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with STOP_LOSS, STOP_LOSS_LIMIT, TAKE_PROFIT, and TAKE_PROFIT_LIMIT orders.',
                    ],
                    'iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with LIMIT, STOP_LOSS_LIMIT, and TAKE_PROFIT_LIMIT to create an iceberg order.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON. MARKET and LIMIT order types default to FULL, all other orders default to ACK.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_api_v3_order' => [
                'class' => BinanceDeleteApiV3Order::class,
                'name' => 'Cancel Order (TRADE)',
                'description' => 'Cancel Order (TRADE)

Cancel an active order. Either `orderId` or `origClientOrderId` must be sent. Weight(IP): 1

Official Binance Spot endpoint: DELETE /api/v3/order.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'orig_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order id from client',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'cancel_restrictions' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `cancelRestrictions`.',
                        'enum' => [
                            'ONLY_NEW',
                            'ONLY_PARTIALLY_FILLED',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_order_cancelreplace' => [
                'class' => BinancePostApiV3OrderCancelreplace::class,
                'name' => 'Cancel an Existing Order and Send a New Order (Trade)',
                'description' => 'Cancel an Existing Order and Send a New Order (Trade)

Cancels an existing order and places a new order on the same symbol. Filters and Order Count are evaluated before the processing of the cancellation and order placement occurs. A new order that was not attempted (i.e. when newOrderResult: NOT_ATTEMPTED), will still increase the order count by 1. Weight(IP): 1

Official Binance Spot endpoint: POST /api/v3/order/cancelReplace.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Order type',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'cancel_replace_mode' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => '- `STOP_ON_FAILURE` If the cancel request fails, the new order placement will not be attempted. - `ALLOW_FAILURES` If new order placement will be attempted even if cancel request fails.',
                    ],
                    'cancel_restrictions' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `cancelRestrictions`.',
                        'enum' => [
                            'ONLY_NEW',
                            'ONLY_PARTIALLY_FILLED',
                        ],
                    ],
                    'time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order time in force',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Order quantity',
                    ],
                    'quote_order_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Quote quantity',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Order price',
                    ],
                    'cancel_new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'cancel_orig_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Either the cancelOrigClientOrderId or cancelOrderId must be provided. If both are provided, cancelOrderId takes precedence.',
                    ],
                    'cancel_order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Either the cancelOrigClientOrderId or cancelOrderId must be provided. If both are provided, cancelOrderId takes precedence.',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'strategy_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `strategyId`.',
                    ],
                    'strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be less than 1000000.',
                    ],
                    'stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with STOP_LOSS, STOP_LOSS_LIMIT, TAKE_PROFIT, and TAKE_PROFIT_LIMIT orders.',
                    ],
                    'trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with STOP_LOSS, STOP_LOSS_LIMIT, TAKE_PROFIT, and TAKE_PROFIT_LIMIT orders.',
                    ],
                    'iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with LIMIT, STOP_LOSS_LIMIT, and TAKE_PROFIT_LIMIT to create an iceberg order.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON. MARKET and LIMIT order types default to FULL, all other orders default to ACK.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_openorders' => [
                'class' => BinanceGetApiV3Openorders::class,
                'name' => 'Current Open Orders (USER_DATA)',
                'description' => 'Current Open Orders (USER_DATA)

Get all open orders on a symbol. Careful when accessing this with no symbol. Weight(IP): - `6` for a single symbol; - `80` when the symbol parameter is omitted;

Official Binance Spot endpoint: GET /api/v3/openOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_api_v3_openorders' => [
                'class' => BinanceDeleteApiV3Openorders::class,
                'name' => 'Cancel all Open Orders on a Symbol (TRADE)',
                'description' => 'Cancel all Open Orders on a Symbol (TRADE)

Cancels all active orders on a symbol. This includes OCO orders. Weight(IP): 1

Official Binance Spot endpoint: DELETE /api/v3/openOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_allorders' => [
                'class' => BinanceGetApiV3Allorders::class,
                'name' => 'All Orders (USER_DATA)',
                'description' => 'All Orders (USER_DATA)

Get all account orders; active, canceled, or filled.. - If `orderId` is set, it will get orders >= that `orderId`. Otherwise most recent orders are returned. - For some historical orders `cummulativeQuoteQty` will be < 0, meaning the data is not available at this time. - If `startTime` and/or `endTime` provided, `orderId` is not required Weight(IP): 20

Official Binance Spot endpoint: GET /api/v3/allOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_orderlist_oco' => [
                'class' => BinancePostApiV3OrderlistOco::class,
                'name' => 'New Order list - OCO (TRADE)',
                'description' => 'New Order list - OCO (TRADE)

Send in an one-cancels-the-other (OCO) pair, where activation of one order immediately cancels the other. - An `OCO` has 2 orders called the above order and below order. - One of the orders must be a `LIMIT_MAKER` order and the other must be `STOP_LOSS` or`STOP_LOSS_LIMIT` order. - Price restrictions: - If the `OCO` is on the `SELL` side: `LIMIT_MAKER` price > Last Traded Price > stopPrice - If the `OCO` is on the `BUY` side: `LIMIT_MAKER` price < Last Traded Price < stopPrice - OCOs add 2 orders to the unfilled order count, `EXCHANGE_MAX_ORDERS` filter, and the `MAX_NUM_ORDERS` filter. Weight(IP): 1

Official Binance Spot endpoint: POST /api/v3/orderList/oco.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open order lists. Automatically generated if not sent. A new order list with the same `listClientOrderId` is accepted only when the previous one is filled or completely expired. `listClientOrderId` is distinct from the `aboveClientOrderId` and the `belowCLientOrderId`.',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `quantity`.',
                    ],
                    'above_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values : `STOP_LOSS_LIMIT`, `STOP_LOSS`, `LIMIT_MAKER`',
                    ],
                    'above_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the above order. Automatically generated if not sent',
                    ],
                    'above_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Note that this can only be used if `aboveTimeInForce` is `GTC`.',
                    ],
                    'above_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `abovePrice`.',
                    ],
                    'above_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Can be used if `aboveType` is `STOP_LOSS` or `STOP_LOSS_LIMIT`. Either `aboveStopPrice` or `aboveTrailingDelta` or both, must be specified.',
                    ],
                    'above_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `aboveTrailingDelta`.',
                    ],
                    'above_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Required if the `aboveType` is `STOP_LOSS_LIMIT`.',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'above_strategy_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the above order within an order strategy.',
                    ],
                    'above_strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the above order strategy. Values smaller than 1000000 are reserved and cannot be used.',
                    ],
                    'below_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values : `STOP_LOSS_LIMIT`, `STOP_LOSS`, `LIMIT_MAKER`',
                    ],
                    'below_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the below order. Automatically generated if not sent',
                    ],
                    'below_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Note that this can only be used if `belowTimeInForce` is `GTC`.',
                    ],
                    'below_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Can be used if `belowType` is `STOP_LOSS_LIMIT` or `LIMIT_MAKER` to specify the limit price.',
                    ],
                    'below_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Can be used if `belowType` is `STOP_LOSS` or `STOP_LOSS_LIMIT`. Either `belowStopPrice` or `belowTrailingDelta` or both, must be specified.',
                    ],
                    'below_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `belowTrailingDelta`.',
                    ],
                    'below_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Required if the `belowType` is `STOP_LOSS_LIMIT`.',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'below_strategy_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the below order within an order strategy.',
                    ],
                    'below_strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the below order strategy. Values smaller than 1000000 are reserved and cannot be used.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON. MARKET and LIMIT order types default to FULL, all other orders default to ACK.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_orderlist_oto' => [
                'class' => BinancePostApiV3OrderlistOto::class,
                'name' => 'New Order List - OTO (TRADE)',
                'description' => 'New Order List - OTO (TRADE)

Places an `OTO`. - An `OTO` (One-Triggers-the-Other) is an order list comprised of 2 orders. - The first order is called the working order and must be `LIMIT` or `LIMIT_MAKER`. Initially, only the working order goes on the order book. - The second order is called the pending order. It can be any order type except for `MARKET` orders using parameter `quoteOrderQty`. The pending order is only placed on the order book when the working order gets fully filled. - If either the working order or the pending order is cancelled individually, the other order in the order list will also be canceled or expired. - When the order list is placed, if the working order gets immediately fully filled, the placement response will show the working order as `FILLED` but the pending order will still appear as `PENDING_NEW`. You need to query the status of the pending order again to see its updated status. - OTOs add 2 orders to the unfilled order count, `EXCHANGE_MAX_NUM_ORDERS` filter and `MAX_NUM_ORDERS` f

Official Binance Spot endpoint: POST /api/v3/orderList/oto.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open order lists. Automatically generated if not sent. A new order list with the same `listClientOrderId` is accepted only when the previous one is filled or completely expired. `listClientOrderId` is distinct from the `workingClientOrderId` and the `pendingClientOrderId`.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'working_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: LIMIT,LIMIT_MAKER',
                        'enum' => [
                            'LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'working_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'working_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the working order. Automatically generated if not sent.',
                    ],
                    'working_price' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `workingPrice`.',
                    ],
                    'working_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the working order.',
                    ],
                    'working_iceberg_qty' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'This can only be used if workingTimeInForce is GTC.',
                    ],
                    'working_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'GTC, IOC, FOK',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'working_strategy_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the working order within an order strategy.',
                    ],
                    'working_strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the working order strategy. Values smaller than 1000000 are reserved and cannot be used.',
                    ],
                    'pending_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: Order Types Note that MARKET orders using quoteOrderQty are not supported.',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'pending_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'pending_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the pending order. Automatically generated if not sent.',
                    ],
                    'pending_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingPrice`.',
                    ],
                    'pending_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingStopPrice`.',
                    ],
                    'pending_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingTrailingDelta`.',
                    ],
                    'pending_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the pending order.',
                    ],
                    'pending_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'This can only be used if pendingTimeInForce is GTC.',
                    ],
                    'pending_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'GTC, IOC, FOK',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'pending_strategy_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the pending order within an order strategy.',
                    ],
                    'pending_strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the pending order strategy. Values smaller than 1000000 are reserved and cannot be used.',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_orderlist_otoco' => [
                'class' => BinancePostApiV3OrderlistOtoco::class,
                'name' => 'New Order List - OTOCO (TRADE)',
                'description' => 'New Order List - OTOCO (TRADE)

Place an `OTOCO`. - An `OTOCO` (One-Triggers-One-Cancels-the-Other) is an order list comprised of 3 orders. - The first order is called the working order and must be `LIMIT` or `LIMIT_MAKER`. Initially, only the working order goes on the order book. - The behavior of the working order is the same as the `OTO`. - `OTOCO` has 2 pending orders (pending above and pending below), forming an `OCO` pair. The pending orders are only placed on the order book when the working order gets fully filled. - The rules of the pending above and pending below follow the same rules as the Order List `OCO`. - OTOCOs add 3 orders against the unfilled order count, `EXCHANGE_MAX_NUM_ORDERS` filter, and `MAX_NUM_ORDERS` filter. Weight: 1

Official Binance Spot endpoint: POST /api/v3/orderList/otoco.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open order lists. Automatically generated if not sent. A new order list with the same `listClientOrderId` is accepted only when the previous one is filled or completely expired. `listClientOrderId` is distinct from the `workingClientOrderId` and the `pendingClientOrderId`.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'working_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: LIMIT,LIMIT_MAKER',
                        'enum' => [
                            'LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'working_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'working_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the working order. Automatically generated if not sent.',
                    ],
                    'working_price' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `workingPrice`.',
                    ],
                    'working_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the working order.',
                    ],
                    'working_iceberg_qty' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'This can only be used if workingTimeInForce is GTC.',
                    ],
                    'working_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'GTC, IOC, FOK',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'working_strategy_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the working order within an order strategy.',
                    ],
                    'working_strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the working order strategy. Values smaller than 1000000 are reserved and cannot be used.',
                    ],
                    'pending_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'pending_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the pending order.',
                    ],
                    'pending_above_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: LIMIT_MAKER, STOP_LOSS, and STOP_LOSS_LIMIT',
                        'enum' => [
                            'LIMIT_MAKER',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                        ],
                    ],
                    'pending_above_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the pending above order. Automatically generated if not sent.',
                    ],
                    'pending_above_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingAbovePrice`.',
                    ],
                    'pending_above_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingAboveStopPrice`.',
                    ],
                    'pending_above_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingAboveTrailingDelta`.',
                    ],
                    'pending_above_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'This can only be used if pendingAboveTimeInForce is GTC.',
                    ],
                    'pending_above_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `pendingAboveTimeInForce`.',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'pending_above_strategy_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the pending above order within an order strategy.',
                    ],
                    'pending_above_strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the pending above order strategy. Values smaller than 1000000 are reserved and cannot be used.',
                    ],
                    'pending_below_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Supported values: LIMIT_MAKER, STOP_LOSS, and STOP_LOSS_LIMIT',
                        'enum' => [
                            'LIMIT_MAKER',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                        ],
                    ],
                    'pending_below_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the pending below order. Automatically generated if not sent.',
                    ],
                    'pending_below_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowPrice`.',
                    ],
                    'pending_below_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowStopPrice`.',
                    ],
                    'pending_below_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowTrailingDelta`.',
                    ],
                    'pending_below_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'This can only be used if pendingBelowTimeInForce is GTC.',
                    ],
                    'pending_below_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowTimeInForce`.',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'pending_below_strategy_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the pending below order within an order strategy.',
                    ],
                    'pending_below_strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Arbitrary numeric value identifying the pending below order strategy. Values smaller than 1000000 are reserved and cannot be used.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_orderlist' => [
                'class' => BinanceGetApiV3Orderlist::class,
                'name' => 'Query OCO (USER_DATA)',
                'description' => 'Query OCO (USER_DATA)

Retrieves a specific OCO based on provided optional parameters Weight(IP): 4

Official Binance Spot endpoint: GET /api/v3/orderList.',
                'parameters' => [
                    'order_list_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order list id',
                    ],
                    'orig_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order id from client',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_api_v3_orderlist' => [
                'class' => BinanceDeleteApiV3Orderlist::class,
                'name' => 'Cancel OCO (TRADE)',
                'description' => 'Cancel OCO (TRADE)

Cancel an entire Order List Canceling an individual leg will cancel the entire OCO Weight(IP): 1

Official Binance Spot endpoint: DELETE /api/v3/orderList.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'order_list_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order list id',
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A unique Id for the entire orderList',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_allorderlist' => [
                'class' => BinanceGetApiV3Allorderlist::class,
                'name' => 'Query all OCO (USER_DATA)',
                'description' => 'Query all OCO (USER_DATA)

Retrieves all OCO based on provided optional parameters Weight(IP): 20

Official Binance Spot endpoint: GET /api/v3/allOrderList.',
                'parameters' => [
                    'from_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Trade id to fetch from. Default gets most recent trades.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_openorderlist' => [
                'class' => BinanceGetApiV3Openorderlist::class,
                'name' => 'Query Open OCO (USER_DATA)',
                'description' => 'Query Open OCO (USER_DATA)

Weight(IP): 6

Official Binance Spot endpoint: GET /api/v3/openOrderList.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_sor_order' => [
                'class' => BinancePostApiV3SorOrder::class,
                'name' => 'New order using SOR (TRADE)',
                'description' => 'New order using SOR (TRADE)

Weight(IP): 6

Official Binance Spot endpoint: POST /api/v3/sor/order.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Order type',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order time in force',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `quantity`.',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `price`.',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'strategy_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `strategyId`.',
                    ],
                    'strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be less than 1000000.',
                    ],
                    'iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with LIMIT, STOP_LOSS_LIMIT, and TAKE_PROFIT_LIMIT to create an iceberg order.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON. MARKET and LIMIT order types default to FULL, all other orders default to ACK.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_sor_order_test' => [
                'class' => BinancePostApiV3SorOrderTest::class,
                'name' => 'Test new order using SOR (TRADE)',
                'description' => 'Test new order using SOR (TRADE)

Test new order creation and signature/recvWindow using smart order routing (SOR). Creates and validates a new order but does not send it into the matching engine. Weight(IP): - Without computeCommissionRates: `1` - With computeCommissionRates: `20`

Official Binance Spot endpoint: POST /api/v3/sor/order/test.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Order type',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order time in force',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `quantity`.',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `price`.',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'strategy_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `strategyId`.',
                    ],
                    'strategy_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be less than 1000000.',
                    ],
                    'iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with LIMIT, STOP_LOSS_LIMIT, and TAKE_PROFIT_LIMIT to create an iceberg order.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON. MARKET and LIMIT order types default to FULL, all other orders default to ACK.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'compute_commission_rates' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Default: false',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_account' => [
                'class' => BinanceGetApiV3Account::class,
                'name' => 'Account Information (USER_DATA)',
                'description' => 'Account Information (USER_DATA)

Get current account information. Weight(IP): 20

Official Binance Spot endpoint: GET /api/v3/account.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_mytrades' => [
                'class' => BinanceGetApiV3Mytrades::class,
                'name' => 'Account Trade List (USER_DATA)',
                'description' => 'Account Trade List (USER_DATA)

Get trades for a specific account and symbol. If `fromId` is set, it will get id >= that `fromId`. Otherwise most recent orders are returned. The time between startTime and endTime can\'t be longer than 24 hours. These are the supported combinations of all parameters: symbol symbol + orderId symbol + startTime symbol + endTime symbol + fromId symbol + startTime + endTime symbol+ orderId + fromId Weight(IP): 20

Official Binance Spot endpoint: GET /api/v3/myTrades.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'This can only be used in combination with symbol.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'from_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Trade id to fetch from. Default gets most recent trades.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_ratelimit_order' => [
                'class' => BinanceGetApiV3RatelimitOrder::class,
                'name' => 'Query Current Order Count Usage (TRADE)',
                'description' => 'Query Current Order Count Usage (TRADE)

Displays the user\'s current order count usage for all intervals. Weight(IP): 40

Official Binance Spot endpoint: GET /api/v3/rateLimit/order.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_mypreventedmatches' => [
                'class' => BinanceGetApiV3Mypreventedmatches::class,
                'name' => 'Query Prevented Matches',
                'description' => 'Query Prevented Matches

Displays the list of orders that were expired because of STP. For additional information on what a Prevented match is, as well as Self Trade Prevention (STP), please refer to our STP FAQ page. These are the combinations supported: * symbol + preventedMatchId * symbol + orderId * symbol + orderId + fromPreventedMatchId (limit will default to 500) * symbol + orderId + fromPreventedMatchId + limit Weight(IP): Case Weight If symbol is invalid: 2 Querying by preventedMatchId: 2 Querying by orderId: 20

Official Binance Spot endpoint: GET /api/v3/myPreventedMatches.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'prevented_match_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `preventedMatchId`.',
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'from_prevented_match_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `fromPreventedMatchId`.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_myallocations' => [
                'class' => BinanceGetApiV3Myallocations::class,
                'name' => 'Query Allocations (USER_DATA)',
                'description' => 'Query Allocations (USER_DATA)

Retrieves allocations resulting from SOR order placement. Weight: 20 Supported parameter combinations: Parameters Response symbol allocations from oldest to newest symbol + startTime oldest allocations since startTime symbol + endTime newest allocations until endTime symbol + startTime + endTime allocations within the time range symbol + fromAllocationId allocations by allocation ID symbol + orderId allocations related to an order starting with oldest symbol + orderId + fromAllocationId allocations related to an order by allocation ID Note: The time between startTime and endTime can\'t be longer than 24 hours.

Official Binance Spot endpoint: GET /api/v3/myAllocations.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'from_allocation_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `fromAllocationId`.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_api_v3_account_commission' => [
                'class' => BinanceGetApiV3AccountCommission::class,
                'name' => 'Query Commission Rates (USER_DATA)',
                'description' => 'Query Commission Rates (USER_DATA)

Get current account commission rates. Weight: 20

Official Binance Spot endpoint: GET /api/v3/account/commission.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_borrow_repay' => [
                'class' => BinancePostSapiV1MarginBorrowRepay::class,
                'name' => 'Margin account borrow/repay(MARGIN)',
                'description' => 'Margin account borrow/repay(MARGIN)

Margin account borrow/repay(MARGIN) Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/margin/borrow-repay.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'TRUE for isolated margin, FALSE for crossed margin',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BORROW or REPAY',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_borrow_repay' => [
                'class' => BinanceGetSapiV1MarginBorrowRepay::class,
                'name' => 'Query borrow/repay records in Margin account(USER_DATA)',
                'description' => 'Query borrow/repay records in Margin account(USER_DATA)

Query borrow/repay records in Margin account - txId or startTime must be sent. txId takes precedence. Response in descending order - If an asset is sent, data within 30 days before endTime; If an asset is not sent, data within 7 days before endTime - If neither startTime nor endTime is sent, the recent 7-day data will be returned. - startTime set as endTime - 7 days by default, endTime set as current time by default Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/borrow-repay.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'isolated_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Isolated symbol',
                    ],
                    'tx_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'tranId in POST /sapi/v1/margin/loan',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BORROW or REPAY',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_transfer' => [
                'class' => BinanceGetSapiV1MarginTransfer::class,
                'name' => 'Get Cross Margin Transfer History (USER_DATA)',
                'description' => 'Get Cross Margin Transfer History (USER_DATA)

- Response in descending order - Returns data for last 7 days by default - Set `archived` to `true` to query data from 6 months ago Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/transfer.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'ROLL_IN',
                            'ROLL_OUT',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'isolated_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Isolated symbol',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_allassets' => [
                'class' => BinanceGetSapiV1MarginAllassets::class,
                'name' => 'Get All Margin Assets (MARKET_DATA)',
                'description' => 'Get All Margin Assets (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/allAssets.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_allpairs' => [
                'class' => BinanceGetSapiV1MarginAllpairs::class,
                'name' => 'Get All Cross Margin Pairs (MARKET_DATA)',
                'description' => 'Get All Cross Margin Pairs (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/allPairs.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_priceindex' => [
                'class' => BinanceGetSapiV1MarginPriceindex::class,
                'name' => 'Query Margin PriceIndex (MARKET_DATA)',
                'description' => 'Query Margin PriceIndex (MARKET_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/priceIndex.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_order' => [
                'class' => BinanceGetSapiV1MarginOrder::class,
                'name' => 'Query Margin Account\'s Order (USER_DATA)',
                'description' => 'Query Margin Account\'s Order (USER_DATA)

- Either `orderId` or `origClientOrderId` must be sent. - For some historical orders `cummulativeQuoteQty` will be < 0, meaning the data is not available at this time. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/order.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'orig_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order id from client',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_order' => [
                'class' => BinancePostSapiV1MarginOrder::class,
                'name' => 'Margin Account New Order (TRADE)',
                'description' => 'Margin Account New Order (TRADE)

Post a new order for margin account. Weight(UID): 6

Official Binance Spot endpoint: POST /sapi/v1/margin/order.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Order type',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `quantity`.',
                    ],
                    'quote_order_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Quote quantity',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Order price',
                    ],
                    'stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with STOP_LOSS, STOP_LOSS_LIMIT, TAKE_PROFIT, and TAKE_PROFIT_LIMIT orders.',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Used with LIMIT, STOP_LOSS_LIMIT, and TAKE_PROFIT_LIMIT to create an iceberg order.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'side_effect_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default `NO_SIDE_EFFECT`',
                        'enum' => [
                            'NO_SIDE_EFFECT',
                            'MARGIN_BUY',
                            'AUTO_REPAY',
                        ],
                    ],
                    'time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order time in force',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'auto_repay_at_cancel' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'query parameter `autoRepayAtCancel`.',
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_margin_order' => [
                'class' => BinanceDeleteSapiV1MarginOrder::class,
                'name' => 'Margin Account Cancel Order (TRADE)',
                'description' => 'Margin Account Cancel Order (TRADE)

Cancel an active order for margin account. Either `orderId` or `origClientOrderId` must be sent. Weight(IP): 10

Official Binance Spot endpoint: DELETE /sapi/v1/margin/order.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'orig_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order id from client',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_interesthistory' => [
                'class' => BinanceGetSapiV1MarginInteresthistory::class,
                'name' => 'Get Interest History (USER_DATA)',
                'description' => 'Get Interest History (USER_DATA)

- Response in descending order - If `isolatedSymbol` is not sent, crossed margin data will be returned - Set `archived` to `true` to query data from 6 months ago - `type` in response has 4 enums: - `PERIODIC` interest charged per hour - `ON_BORROW` first interest charged on borrow - `PERIODIC_CONVERTED` interest charged per hour converted into BNB - `ON_BORROW_CONVERTED` first interest charged on borrow converted into BNB Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/interestHistory.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'isolated_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Isolated symbol',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'archived' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default: false. Set to true for archived data from 6 months ago',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_forceliquidationrec' => [
                'class' => BinanceGetSapiV1MarginForceliquidationrec::class,
                'name' => 'Get Force Liquidation Record (USER_DATA)',
                'description' => 'Get Force Liquidation Record (USER_DATA)

- Response in descending order Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/forceLiquidationRec.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'isolated_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Isolated symbol',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_account' => [
                'class' => BinanceGetSapiV1MarginAccount::class,
                'name' => 'Query Cross Margin Account Details (USER_DATA)',
                'description' => 'Query Cross Margin Account Details (USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/account.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_openorders' => [
                'class' => BinanceGetSapiV1MarginOpenorders::class,
                'name' => 'Query Margin Account\'s Open Orders (USER_DATA)',
                'description' => 'Query Margin Account\'s Open Orders (USER_DATA)

- If the `symbol` is not sent, orders for all symbols will be returned in an array. - When all symbols are returned, the number of requests counted against the rate limiter is equal to the number of symbols currently trading on the exchange - If isIsolated ="TRUE", symbol must be sent. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/openOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_margin_openorders' => [
                'class' => BinanceDeleteSapiV1MarginOpenorders::class,
                'name' => 'Margin Account Cancel all Open Orders on a Symbol (TRADE)',
                'description' => 'Margin Account Cancel all Open Orders on a Symbol (TRADE)

- Cancels all active orders on a symbol for margin account. - This includes OCO orders. Weight(IP): 1

Official Binance Spot endpoint: DELETE /sapi/v1/margin/openOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_allorders' => [
                'class' => BinanceGetSapiV1MarginAllorders::class,
                'name' => 'Query Margin Account\'s All Orders (USER_DATA)',
                'description' => 'Query Margin Account\'s All Orders (USER_DATA)

- If `orderId` is set, it will get orders >= that orderId. Otherwise most recent orders are returned. - For some historical orders `cummulativeQuoteQty` will be < 0, meaning the data is not available at this time. Weight(IP): 200 Request Limit: 60 times/min per IP

Official Binance Spot endpoint: GET /sapi/v1/margin/allOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_order_oco' => [
                'class' => BinancePostSapiV1MarginOrderOco::class,
                'name' => 'Margin Account New OCO (TRADE)',
                'description' => 'Margin Account New OCO (TRADE)

Send in a new OCO for a margin account - Price Restrictions: - SELL: Limit Price > Last Price > Stop Price - BUY: Limit Price < Last Price < Stop Price - Quantity Restrictions: - Both legs must have the same quantity - ICEBERG quantities however do not have to be the same. - Order Rate Limit - OCO counts as 2 orders against the order rate limit. Weight(UID): 6

Official Binance Spot endpoint: POST /sapi/v1/margin/order/oco.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A unique Id for the entire orderList',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `quantity`.',
                    ],
                    'limit_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A unique Id for the limit order',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Order price',
                    ],
                    'limit_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `limitIcebergQty`.',
                    ],
                    'stop_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A unique Id for the stop loss/stop loss limit leg',
                    ],
                    'stop_price' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `stopPrice`.',
                    ],
                    'stop_limit_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'If provided, stopLimitTimeInForce is required.',
                    ],
                    'stop_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `stopIcebergQty`.',
                    ],
                    'stop_limit_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `stopLimitTimeInForce`.',
                        'enum' => [
                            'GTC',
                            'FOK',
                            'IOC',
                        ],
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'side_effect_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default `NO_SIDE_EFFECT`',
                        'enum' => [
                            'NO_SIDE_EFFECT',
                            'MARGIN_BUY',
                            'AUTO_REPAY',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_orderlist' => [
                'class' => BinanceGetSapiV1MarginOrderlist::class,
                'name' => 'Query Margin Account\'s OCO (USER_DATA)',
                'description' => 'Query Margin Account\'s OCO (USER_DATA)

Retrieves a specific OCO based on provided optional parameters - Either `orderListId` or `origClientOrderId` must be provided Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/orderList.',
                'parameters' => [
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Mandatory for isolated margin, not supported for cross margin',
                    ],
                    'order_list_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order list id',
                    ],
                    'orig_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Order id from client',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_margin_orderlist' => [
                'class' => BinanceDeleteSapiV1MarginOrderlist::class,
                'name' => 'Margin Account Cancel OCO (TRADE)',
                'description' => 'Margin Account Cancel OCO (TRADE)

Cancel an entire Order List for a margin account - Canceling an individual leg will cancel the entire OCO - Either `orderListId` or `listClientOrderId` must be provided Weight(UID): 1

Official Binance Spot endpoint: DELETE /sapi/v1/margin/orderList.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'order_list_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order list id',
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A unique Id for the entire orderList',
                    ],
                    'new_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Used to uniquely identify this cancel. Automatically generated by default',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_allorderlist' => [
                'class' => BinanceGetSapiV1MarginAllorderlist::class,
                'name' => 'Query Margin Account\'s all OCO (USER_DATA)',
                'description' => 'Query Margin Account\'s all OCO (USER_DATA)

Retrieves all OCO for a specific margin account based on provided optional parameters Weight(IP): 200

Official Binance Spot endpoint: GET /sapi/v1/margin/allOrderList.',
                'parameters' => [
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Mandatory for isolated margin, not supported for cross margin',
                    ],
                    'from_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'If supplied, neither `startTime` or `endTime` can be provided',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default Value: 500; Max Value: 1000',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_openorderlist' => [
                'class' => BinanceGetSapiV1MarginOpenorderlist::class,
                'name' => 'Query Margin Account\'s Open OCO (USER_DATA)',
                'description' => 'Query Margin Account\'s Open OCO (USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/openOrderList.',
                'parameters' => [
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Mandatory for isolated margin, not supported for cross margin',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_mytrades' => [
                'class' => BinanceGetSapiV1MarginMytrades::class,
                'name' => 'Query Margin Account\'s Trade List (USER_DATA)',
                'description' => 'Query Margin Account\'s Trade List (USER_DATA)

- If `fromId` is set, it will get orders >= that `fromId`. Otherwise most recent trades are returned. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/myTrades.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'from_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Trade id to fetch from. Default gets most recent trades.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_maxborrowable' => [
                'class' => BinanceGetSapiV1MarginMaxborrowable::class,
                'name' => 'Query Max Borrow (USER_DATA)',
                'description' => 'Query Max Borrow (USER_DATA)

- If `isolatedSymbol` is not sent, crossed margin data will be sent. - `borrowLimit` is also available from https://www.binance.com/en/margin-fee Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/margin/maxBorrowable.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'isolated_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Isolated symbol',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_maxtransferable' => [
                'class' => BinanceGetSapiV1MarginMaxtransferable::class,
                'name' => 'Query Max Transfer-Out Amount (USER_DATA)',
                'description' => 'Query Max Transfer-Out Amount (USER_DATA)

- If `isolatedSymbol` is not sent, crossed margin data will be sent. Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/margin/maxTransferable.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'isolated_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Isolated symbol',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_tradecoeff' => [
                'class' => BinanceGetSapiV1MarginTradecoeff::class,
                'name' => 'Get Summary of Margin account (USER_DATA)',
                'description' => 'Get Summary of Margin account (USER_DATA)

Get personal margin level information Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/tradeCoeff.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Email Address',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_isolated_account' => [
                'class' => BinanceGetSapiV1MarginIsolatedAccount::class,
                'name' => 'Query Isolated Margin Account Info (USER_DATA)',
                'description' => 'Query Isolated Margin Account Info (USER_DATA)

- If "symbols" is not sent, all isolated assets will be returned. - If "symbols" is sent, only the isolated assets of the sent symbols will be returned. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/isolated/account.',
                'parameters' => [
                    'symbols' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Max 5 symbols can be sent; separated by \',\'',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_margin_isolated_account' => [
                'class' => BinanceDeleteSapiV1MarginIsolatedAccount::class,
                'name' => 'Disable Isolated Margin Account (TRADE)',
                'description' => 'Disable Isolated Margin Account (TRADE)

Disable isolated margin account for a specific symbol. Each trading pair can only be deactivated once every 24 hours . Weight(UID): 300

Official Binance Spot endpoint: DELETE /sapi/v1/margin/isolated/account.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_isolated_account' => [
                'class' => BinancePostSapiV1MarginIsolatedAccount::class,
                'name' => 'Enable Isolated Margin Account (TRADE)',
                'description' => 'Enable Isolated Margin Account (TRADE)

Enable isolated margin account for a specific symbol. Weight(UID): 300

Official Binance Spot endpoint: POST /sapi/v1/margin/isolated/account.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_isolated_accountlimit' => [
                'class' => BinanceGetSapiV1MarginIsolatedAccountlimit::class,
                'name' => 'Query Enabled Isolated Margin Account Limit (USER_DATA)',
                'description' => 'Query Enabled Isolated Margin Account Limit (USER_DATA)

Query enabled isolated margin account limit. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/isolated/accountLimit.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_isolated_allpairs' => [
                'class' => BinanceGetSapiV1MarginIsolatedAllpairs::class,
                'name' => 'Get All Isolated Margin Symbol(USER_DATA)',
                'description' => 'Get All Isolated Margin Symbol(USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/isolated/allPairs.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_bnbburn' => [
                'class' => BinancePostSapiV1Bnbburn::class,
                'name' => 'Toggle BNB Burn On Spot Trade And Margin Interest (USER_DATA)',
                'description' => 'Toggle BNB Burn On Spot Trade And Margin Interest (USER_DATA)

- "spotBNBBurn" and "interestBNBBurn" should be sent at least one. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/bnbBurn.',
                'parameters' => [
                    'spot_bnb_burn' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Determines whether to use BNB to pay for trading fees on SPOT',
                        'enum' => [
                            'true',
                            'false',
                        ],
                    ],
                    'interest_bnb_burn' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Determines whether to use BNB to pay for margin loan\'s interest',
                        'enum' => [
                            'true',
                            'false',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_bnbburn' => [
                'class' => BinanceGetSapiV1Bnbburn::class,
                'name' => 'Get BNB Burn Status(USER_DATA)',
                'description' => 'Get BNB Burn Status(USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/bnbBurn.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_interestratehistory' => [
                'class' => BinanceGetSapiV1MarginInterestratehistory::class,
                'name' => 'Margin Interest Rate History (USER_DATA)',
                'description' => 'Margin Interest Rate History (USER_DATA)

The max interval between startTime and endTime is 30 days. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/interestRateHistory.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'vip_level' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Defaults to user\'s vip level',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_crossmargindata' => [
                'class' => BinanceGetSapiV1MarginCrossmargindata::class,
                'name' => 'Query Cross Margin Fee Data (USER_DATA)',
                'description' => 'Query Cross Margin Fee Data (USER_DATA)

Get cross margin fee data collection with any vip level or user\'s current specific data as https://www.binance.com/en/margin-fee Weight(IP): 1 when coin is specified; 5 when the coin parameter is omitted

Official Binance Spot endpoint: GET /sapi/v1/margin/crossMarginData.',
                'parameters' => [
                    'vip_level' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Defaults to user\'s vip level',
                    ],
                    'coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin name',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_isolatedmargindata' => [
                'class' => BinanceGetSapiV1MarginIsolatedmargindata::class,
                'name' => 'Query Isolated Margin Fee Data (USER_DATA)',
                'description' => 'Query Isolated Margin Fee Data (USER_DATA)

Get isolated margin fee data collection with any vip level or user\'s current specific data as https://www.binance.com/en/margin-fee Weight(IP): 1 when a single is specified; 10 when the symbol parameter is omitted

Official Binance Spot endpoint: GET /sapi/v1/margin/isolatedMarginData.',
                'parameters' => [
                    'vip_level' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Defaults to user\'s vip level',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_isolatedmargintier' => [
                'class' => BinanceGetSapiV1MarginIsolatedmargintier::class,
                'name' => 'Query Isolated Margin Tier Data (USER_DATA)',
                'description' => 'Query Isolated Margin Tier Data (USER_DATA)

Get isolated margin tier data collection with any tier as https://www.binance.com/en/margin-data Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/isolatedMarginTier.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'tier' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'All margin tier data will be returned if tier is omitted',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_ratelimit_order' => [
                'class' => BinanceGetSapiV1MarginRatelimitOrder::class,
                'name' => 'Query Current Margin Order Count Usage (TRADE)',
                'description' => 'Query Current Margin Order Count Usage (TRADE)

Displays the user\'s current margin order count usage for all intervals. Weight(IP): 20

Official Binance Spot endpoint: GET /sapi/v1/margin/rateLimit/order.',
                'parameters' => [
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'isolated symbol, mandatory for isolated margin',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_crossmargincollateralratio' => [
                'class' => BinanceGetSapiV1MarginCrossmargincollateralratio::class,
                'name' => 'Cross margin collateral ratio (MARKET_DATA)',
                'description' => 'Cross margin collateral ratio (MARKET_DATA)

Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/crossMarginCollateralRatio.',
                'parameters' => [],
            ],
            'binance_get_sapi_v1_margin_exchange_small_liability' => [
                'class' => BinanceGetSapiV1MarginExchangeSmallLiability::class,
                'name' => 'Get Small Liability Exchange Coin List (USER_DATA)',
                'description' => 'Get Small Liability Exchange Coin List (USER_DATA)

Query the coins which can be small liability exchange Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/exchange-small-liability.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_exchange_small_liability_history' => [
                'class' => BinanceGetSapiV1MarginExchangeSmallLiabilityHistory::class,
                'name' => 'Get Small Liability Exchange History (USER_DATA)',
                'description' => 'Get Small Liability Exchange History (USER_DATA)

Get Small liability Exchange History Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/exchange-small-liability-history.',
                'parameters' => [
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_next_hourly_interest_rate' => [
                'class' => BinanceGetSapiV1MarginNextHourlyInterestRate::class,
                'name' => 'Get a future hourly interest rate (USER_DATA)',
                'description' => 'Get a future hourly interest rate (USER_DATA)

Get user the next hourly estimate interest Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/next-hourly-interest-rate.',
                'parameters' => [
                    'assets' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'List of assets, separated by commas, up to 20',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'for isolated margin or not, "TRUE", "FALSE"',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_capital_flow' => [
                'class' => BinanceGetSapiV1MarginCapitalFlow::class,
                'name' => 'Get cross or isolated margin capital flow(USER_DATA)',
                'description' => 'Get cross or isolated margin capital flow(USER_DATA)

Get cross or isolated margin capital flow Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/capital-flow.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Required when querying isolated data',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'TRANSFER',
                            'BORROW',
                            'REPAY',
                            'BUY_INCOME',
                            'BUY_EXPENSE',
                            'SELL_INCOME',
                            'SELL_EXPENSE',
                            'TRADING_COMMISSION',
                            'BUY_LIQUIDATION',
                            'SELL_LIQUIDATION',
                            'REPAY_LIQUIDATION',
                            'OTHER_LIQUIDATION',
                            'LIQUIDATION_FEE',
                            'SMALL_BALANCE_CONVERT',
                            'COMMISSION_RETURN',
                            'SMALL_CONVERT',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Only supports querying the data of the last 90 days',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'from_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'If fromId is set, the data with id > fromId will be returned. Otherwise the latest data will be returned',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of data items returned each time is limited. Default 500; Max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_delist_schedule' => [
                'class' => BinanceGetSapiV1MarginDelistSchedule::class,
                'name' => 'Get tokens or symbols delist schedule for cross margin and isolated margin (MARKET_DATA)',
                'description' => 'Get tokens or symbols delist schedule for cross margin and isolated margin (MARKET_DATA)

Get tokens or symbols delist schedule for cross margin and isolated margin Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/delist-schedule.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_available_inventory' => [
                'class' => BinanceGetSapiV1MarginAvailableInventory::class,
                'name' => 'Query Margin Available Inventory (USER_DATA)',
                'description' => 'Query Margin Available Inventory (USER_DATA)

Margin available Inventory query Weight(UID): 50

Official Binance Spot endpoint: GET /sapi/v1/margin/available-inventory.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'MARGIN',
                            'ISOLATED',
                        ],
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_manual_liquidation' => [
                'class' => BinancePostSapiV1MarginManualLiquidation::class,
                'name' => 'Margin manual liquidation(MARGIN)',
                'description' => 'Margin manual liquidation(MARGIN)

Margin manual liquidation Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/margin/manual-liquidation.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'MARGIN',
                            'ISOLATED',
                        ],
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `symbol`.',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_order_oto' => [
                'class' => BinancePostSapiV1MarginOrderOto::class,
                'name' => 'Margin Account New OTO (TRADE)',
                'description' => 'Margin Account New OTO (TRADE)

Post a new `OTO` order for margin account: - An `OTO` (One-Triggers-the-Other) is an order list comprised of 2 orders - The first order is called the working order and must be `LIMIT` or `LIMIT_MAKER`. Initially, only the working order goes on the order book. - The second order is called the pending order. It can be any order type except for `MARKET` orders using parameter `quoteOrderQty`. The pending order is only placed on the order book when the working order gets fully filled. - If either the working order or the pending order is cancelled individually, the other order in the order list will also be canceled or expired. - When the order list is placed, if the working order gets immediately fully filled, the placement response will show the working order as `FILLED` but the pending order will still appear as `PENDING_NEW`. You need to query the status of the pending order again to see its updated status. - OTOs add 2 orders to the unfilled order count, `EXCHANGE_MAX_NUM_ORDERS` filt

Official Binance Spot endpoint: POST /sapi/v1/margin/order/oto.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open order lists. Automatically generated if not sent. A new order list with the same `listClientOrderId` is accepted only when the previous one is filled or completely expired. `listClientOrderId` is distinct from the `workingClientOrderId` and the `pendingClientOrderId`.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'side_effect_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default `NO_SIDE_EFFECT`',
                        'enum' => [
                            'NO_SIDE_EFFECT',
                            'MARGIN_BUY',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'auto_repay_at_cancel' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Only when MARGIN_BUY order takes effect, true means that the debt generated by the order needs to be repay after the order is cancelled. The default is true',
                    ],
                    'working_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: LIMIT,LIMIT_MAKER',
                        'enum' => [
                            'LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'working_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'working_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the working order. Automatically generated if not sent.',
                    ],
                    'working_price' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `workingPrice`.',
                    ],
                    'working_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the working order.',
                    ],
                    'working_iceberg_qty' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'This can only be used if workingTimeInForce is GTC.',
                    ],
                    'working_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'GTC, IOC, FOK',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'pending_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: Order Types Note that MARKET orders using quoteOrderQty are not supported.',
                        'enum' => [
                            'LIMIT',
                            'MARKET',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                            'TAKE_PROFIT',
                            'TAKE_PROFIT_LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'pending_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'pending_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the pending order. Automatically generated if not sent.',
                    ],
                    'pending_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingPrice`.',
                    ],
                    'pending_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingStopPrice`.',
                    ],
                    'pending_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingTrailingDelta`.',
                    ],
                    'pending_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the pending order.',
                    ],
                    'pending_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'This can only be used if pendingTimeInForce is GTC.',
                    ],
                    'pending_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'GTC, IOC, FOK',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_order_otoco' => [
                'class' => BinancePostSapiV1MarginOrderOtoco::class,
                'name' => 'Margin Account New OTOCO (TRADE)',
                'description' => 'Margin Account New OTOCO (TRADE)

Post a new `OTOCO` order for margin account: - An `OTOCO` (One-Triggers-the-Other-Cancel-the-Other) is an order list comprised of 3 orders - The first order is called the working order and must be `LIMIT` or `LIMIT_MAKER`. Initially, only the working order goes on the order book. - The behavior of the working order is the same as the `OTO`. - `OTOCO` has 2 pending orders (pending above and pending below), forming an `OCO` pair. The pending orders are only placed on the order book when the working order gets fully filled. - The rules of the pending above and pending below follow the same rules as the Order List `OCO`. - OTOCOs add 3 orders to the unfilled order count, `EXCHANGE_MAX_NUM_ORDERS` filter and `MAX_NUM_ORDERS` filter. Weight(UID): 6

Official Binance Spot endpoint: POST /sapi/v1/margin/order/otoco.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'is_isolated' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'side_effect_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default `NO_SIDE_EFFECT`',
                        'enum' => [
                            'NO_SIDE_EFFECT',
                            'MARGIN_BUY',
                        ],
                    ],
                    'auto_repay_at_cancel' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Only when MARGIN_BUY order takes effect, true means that the debt generated by the order needs to be repay after the order is cancelled. The default is true',
                    ],
                    'list_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open order lists. Automatically generated if not sent. A new order list with the same `listClientOrderId` is accepted only when the previous one is filled or completely expired. `listClientOrderId` is distinct from the `workingClientOrderId` and the `pendingClientOrderId`.',
                    ],
                    'new_order_resp_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Set the response JSON.',
                        'enum' => [
                            'ACK',
                            'RESULT',
                            'FULL',
                        ],
                    ],
                    'self_trade_prevention_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
                        'enum' => [
                            'EXPIRE_TAKER',
                            'EXPIRE_MAKER',
                            'EXPIRE_BOTH',
                            'NONE',
                        ],
                    ],
                    'working_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: LIMIT,LIMIT_MAKER',
                        'enum' => [
                            'LIMIT',
                            'LIMIT_MAKER',
                        ],
                    ],
                    'working_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'working_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the working order. Automatically generated if not sent.',
                    ],
                    'working_price' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `workingPrice`.',
                    ],
                    'working_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the working order.',
                    ],
                    'working_iceberg_qty' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'This can only be used if workingTimeInForce is GTC.',
                    ],
                    'working_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'GTC, IOC, FOK',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'pending_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BUY,SELL',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'pending_quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Sets the quantity for the pending order.',
                    ],
                    'pending_above_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Supported values: LIMIT_MAKER, STOP_LOSS, and STOP_LOSS_LIMIT',
                        'enum' => [
                            'LIMIT_MAKER',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                        ],
                    ],
                    'pending_above_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the pending above order. Automatically generated if not sent.',
                    ],
                    'pending_above_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingAbovePrice`.',
                    ],
                    'pending_above_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingAboveStopPrice`.',
                    ],
                    'pending_above_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingAboveTrailingDelta`.',
                    ],
                    'pending_above_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'This can only be used if pendingAboveTimeInForce is GTC.',
                    ],
                    'pending_above_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `pendingAboveTimeInForce`.',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'pending_below_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Supported values: LIMIT_MAKER, STOP_LOSS, and STOP_LOSS_LIMIT',
                        'enum' => [
                            'LIMIT_MAKER',
                            'STOP_LOSS',
                            'STOP_LOSS_LIMIT',
                        ],
                    ],
                    'pending_below_client_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Arbitrary unique ID among open orders for the pending below order. Automatically generated if not sent.',
                    ],
                    'pending_below_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowPrice`.',
                    ],
                    'pending_below_stop_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowStopPrice`.',
                    ],
                    'pending_below_trailing_delta' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowTrailingDelta`.',
                    ],
                    'pending_below_iceberg_qty' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'This can only be used if pendingBelowTimeInForce is GTC.',
                    ],
                    'pending_below_time_in_force' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `pendingBelowTimeInForce`.',
                        'enum' => [
                            'GTC',
                            'IOC',
                            'FOK',
                        ],
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_margin_max_leverage' => [
                'class' => BinancePostSapiV1MarginMaxLeverage::class,
                'name' => 'Adjust cross margin max leverage (USER_DATA)',
                'description' => 'Adjust cross margin max leverage (USER_DATA)

Adjust cross margin max leverage Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/margin/max-leverage.',
                'parameters' => [
                    'max_leverage' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'Can only adjust 3 or 5',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_margin_leveragebracket' => [
                'class' => BinanceGetSapiV1MarginLeveragebracket::class,
                'name' => 'Query Liability Coin Leverage Bracket in Cross Margin Pro Mode (MARKET_DATA)',
                'description' => 'Query Liability Coin Leverage Bracket in Cross Margin Pro Mode (MARKET_DATA)

Liability Coin Leverage Bracket in Cross Margin Pro Mode Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/leverageBracket.',
                'parameters' => [],
            ],
            'binance_get_sapi_v1_system_status' => [
                'class' => BinanceGetSapiV1SystemStatus::class,
                'name' => 'System Status (System)',
                'description' => 'System Status (System)

Fetch system status. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/system/status.',
                'parameters' => [],
            ],
            'binance_get_sapi_v1_capital_config_getall' => [
                'class' => BinanceGetSapiV1CapitalConfigGetall::class,
                'name' => 'All Coins\' Information (USER_DATA)',
                'description' => 'All Coins\' Information (USER_DATA)

Get information of coins (available for deposit and withdraw) for user. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/config/getall.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_accountsnapshot' => [
                'class' => BinanceGetSapiV1Accountsnapshot::class,
                'name' => 'Daily Account Snapshot (USER_DATA)',
                'description' => 'Daily Account Snapshot (USER_DATA)

- The query time period must be less than 30 days - Support query within the last one month only - If startTimeand endTime not sent, return records of the last 7 days by default Weight(IP): 2400

Official Binance Spot endpoint: GET /sapi/v1/accountSnapshot.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'SPOT',
                            'MARGIN',
                            'FUTURES',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `limit`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_account_disablefastwithdrawswitch' => [
                'class' => BinancePostSapiV1AccountDisablefastwithdrawswitch::class,
                'name' => 'Disable Fast Withdraw Switch (USER_DATA)',
                'description' => 'Disable Fast Withdraw Switch (USER_DATA)

- This request will disable fastwithdraw switch under your account. - You need to enable "trade" option for the api key which requests this endpoint. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/account/disableFastWithdrawSwitch.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_account_enablefastwithdrawswitch' => [
                'class' => BinancePostSapiV1AccountEnablefastwithdrawswitch::class,
                'name' => 'Enable Fast Withdraw Switch (USER_DATA)',
                'description' => 'Enable Fast Withdraw Switch (USER_DATA)

- This request will enable fastwithdraw switch under your account. You need to enable "trade" option for the api key which requests this endpoint. - When Fast Withdraw Switch is on, transferring funds to a Binance account will be done instantly. There is no on-chain transaction, no transaction ID and no withdrawal fee. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/account/enableFastWithdrawSwitch.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_capital_withdraw_apply' => [
                'class' => BinancePostSapiV1CapitalWithdrawApply::class,
                'name' => 'Withdraw (USER_DATA)',
                'description' => 'Withdraw (USER_DATA)

Submit a withdraw request. - If `network` not send, return with default network of the coin. - You can get `network` and `isDefault` in `networkList` of a coin in the response of `Get /sapi/v1/capital/config/getall (HMAC SHA256)`. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/capital/withdraw/apply.',
                'parameters' => [
                    'coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin name',
                    ],
                    'withdraw_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Client id for withdraw',
                    ],
                    'network' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `network`.',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `address`.',
                    ],
                    'address_tag' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Secondary address identifier for coins like XRP,XMR etc.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'transaction_fee_flag' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'When making internal transfer - `true` -> returning the fee to the destination account; - `false` -> returning the fee back to the departure account.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `name`.',
                    ],
                    'wallet_type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The wallet type for withdraw，0-Spot wallet, 1- Funding wallet. Default is Spot wallet',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_deposit_hisrec' => [
                'class' => BinanceGetSapiV1CapitalDepositHisrec::class,
                'name' => 'Deposit History(supporting network) (USER_DATA)',
                'description' => 'Deposit History(supporting network) (USER_DATA)

Fetch deposit history. - Please notice the default `startTime` and `endTime` to make sure that time interval is within 0-90 days. - If both `startTime` and `endTime` are sent, time between `startTime` and `endTime` must be less than 90 days. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/hisrec.',
                'parameters' => [
                    'coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin name',
                    ],
                    'status' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => '* `0` - pending * `6` - credited but cannot withdraw * `1` - success',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `offset`.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_withdraw_history' => [
                'class' => BinanceGetSapiV1CapitalWithdrawHistory::class,
                'name' => 'Withdraw History (supporting network) (USER_DATA)',
                'description' => 'Withdraw History (supporting network) (USER_DATA)

Fetch withdraw history. This endpoint specifically uses per second UID rate limit, user\'s total second level IP rate limit is 180000/second. Response from the endpoint contains header key X-SAPI-USED-UID-WEIGHT-1S, which defines weight used by the current IP. - `network` may not be in the response for old withdraw. - Please notice the default `startTime` and `endTime` to make sure that time interval is within 0-90 days. - If both `startTime` and `endTime` are sent, time between `startTime` and `endTime` must be less than 90 days - If withdrawOrderId is sent, time between startTime and endTime must be less than 7 days. - If withdrawOrderId is sent, startTime and endTime are not sent, will return last 7 days records by default. Weight(UID): 18000 Request Limit: 10 requests per second

Official Binance Spot endpoint: GET /sapi/v1/capital/withdraw/history.',
                'parameters' => [
                    'coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin name',
                    ],
                    'withdraw_order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `withdrawOrderId`.',
                    ],
                    'status' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => '* `0` - Email Sent * `1` - Cancelled * `2` - Awaiting Approval * `3` - Rejected * `4` - Processing * `5` - Failure * `6` - Completed',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `offset`.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_deposit_address' => [
                'class' => BinanceGetSapiV1CapitalDepositAddress::class,
                'name' => 'Deposit Address (supporting network) (USER_DATA)',
                'description' => 'Deposit Address (supporting network) (USER_DATA)

Fetch deposit address with network. - If network is not send, return with default network of the coin. - You can get network and isDefault in networkList in the response of Get /sapi/v1/capital/config/getall (HMAC SHA256). Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/address.',
                'parameters' => [
                    'coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin name',
                    ],
                    'network' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `network`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_account_status' => [
                'class' => BinanceGetSapiV1AccountStatus::class,
                'name' => 'Account Status (USER_DATA)',
                'description' => 'Account Status (USER_DATA)

Fetch account status detail. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/account/status.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_account_apitradingstatus' => [
                'class' => BinanceGetSapiV1AccountApitradingstatus::class,
                'name' => 'Account API Trading Status (USER_DATA)',
                'description' => 'Account API Trading Status (USER_DATA)

Fetch account API trading status with details. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/account/apiTradingStatus.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_dribblet' => [
                'class' => BinanceGetSapiV1AssetDribblet::class,
                'name' => 'DustLog(USER_DATA)',
                'description' => 'DustLog(USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/dribblet.',
                'parameters' => [
                    'account_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT or MARGIN, default SPOT',
                        'enum' => [
                            'SPOT',
                            'MARGIN',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_asset_dust_btc' => [
                'class' => BinancePostSapiV1AssetDustBtc::class,
                'name' => 'Get Assets That Can Be Converted Into BNB (USER_DATA)',
                'description' => 'Get Assets That Can Be Converted Into BNB (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/asset/dust-btc.',
                'parameters' => [
                    'account_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT or MARGIN, default SPOT',
                        'enum' => [
                            'SPOT',
                            'MARGIN',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_asset_dust' => [
                'class' => BinancePostSapiV1AssetDust::class,
                'name' => 'Dust Transfer (USER_DATA)',
                'description' => 'Dust Transfer (USER_DATA)

Convert dust assets to BNB. Weight(UID): 10

Official Binance Spot endpoint: POST /sapi/v1/asset/dust.',
                'parameters' => [
                    'asset' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'The asset being converted. For example, asset=BTC&asset=USDT',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'account_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT or MARGIN, default SPOT',
                        'enum' => [
                            'SPOT',
                            'MARGIN',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_assetdividend' => [
                'class' => BinanceGetSapiV1AssetAssetdividend::class,
                'name' => 'Asset Dividend Record (USER_DATA)',
                'description' => 'Asset Dividend Record (USER_DATA)

Query asset Dividend Record Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/asset/assetDividend.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `limit`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_assetdetail' => [
                'class' => BinanceGetSapiV1AssetAssetdetail::class,
                'name' => 'Asset Detail (USER_DATA)',
                'description' => 'Asset Detail (USER_DATA)

Fetch details of assets supported on Binance. - Please get network and other deposit or withdraw details from `GET /sapi/v1/capital/config/getall`. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/assetDetail.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_tradefee' => [
                'class' => BinanceGetSapiV1AssetTradefee::class,
                'name' => 'Trade Fee (USER_DATA)',
                'description' => 'Trade Fee (USER_DATA)

Fetch trade fee Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/tradeFee.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_transfer' => [
                'class' => BinanceGetSapiV1AssetTransfer::class,
                'name' => 'Query User Universal Transfer History (USER_DATA)',
                'description' => 'Query User Universal Transfer History (USER_DATA)

- `fromSymbol` must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN - `toSymbol` must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN - Support query within the last 6 months only - If `startTime` and `endTime` not sent, return records of the last 7 days by default Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/transfer.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Universal transfer type',
                        'enum' => [
                            'MAIN_C2C',
                            'MAIN_UMFUTURE',
                            'MAIN_CMFUTURE',
                            'MAIN_MARGIN',
                            'MAIN_MINING',
                            'C2C_MAIN',
                            'C2C_UMFUTURE',
                            'C2C_MINING',
                            'C2C_MARGIN',
                            'UMFUTURE_MAIN',
                            'UMFUTURE_C2C',
                            'UMFUTURE_MARGIN',
                            'CMFUTURE_MAIN',
                            'CMFUTURE_MARGIN',
                            'MARGIN_MAIN',
                            'MARGIN_UMFUTURE',
                            'MARGIN_CMFUTURE',
                            'MARGIN_MINING',
                            'MARGIN_C2C',
                            'MINING_MAIN',
                            'MINING_UMFUTURE',
                            'MINING_C2C',
                            'MINING_MARGIN',
                            'MAIN_PAY',
                            'PAY_MAIN',
                            'ISOLATEDMARGIN_MARGIN',
                            'MARGIN_ISOLATEDMARGIN',
                            'ISOLATEDMARGIN_ISOLATEDMARGIN',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'from_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
                    ],
                    'to_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_asset_transfer' => [
                'class' => BinancePostSapiV1AssetTransfer::class,
                'name' => 'User Universal Transfer (USER_DATA)',
                'description' => 'User Universal Transfer (USER_DATA)

You need to enable `Permits Universal Transfer` option for the api key which requests this endpoint. - `fromSymbol` must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN - `toSymbol` must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN ENUM of transfer types: - MAIN_UMFUTURE Spot account transfer to USDⓈ-M Futures account - MAIN_CMFUTURE Spot account transfer to COIN-M Futures account - MAIN_MARGIN Spot account transfer to Margin(cross)account - UMFUTURE_MAIN USDⓈ-M Futures account transfer to Spot account - UMFUTURE_MARGIN USDⓈ-M Futures account transfer to Margin(cross)account - CMFUTURE_MAIN COIN-M Futures account transfer to Spot account - CMFUTURE_MARGIN COIN-M Futures account transfer to Margin(cross) account - MARGIN_MAIN Margin(cross)account transfer to Spot account - MARGIN_UMFUTURE Margin(cross)account transfer to USDⓈ-M Futures - MARGIN_CMFUTURE Margin(cross)account transfer to COIN-M Futures - ISOLATEDMARGIN_MARGIN

Official Binance Spot endpoint: POST /sapi/v1/asset/transfer.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Universal transfer type',
                        'enum' => [
                            'MAIN_C2C',
                            'MAIN_UMFUTURE',
                            'MAIN_CMFUTURE',
                            'MAIN_MARGIN',
                            'MAIN_MINING',
                            'C2C_MAIN',
                            'C2C_UMFUTURE',
                            'C2C_MINING',
                            'C2C_MARGIN',
                            'UMFUTURE_MAIN',
                            'UMFUTURE_C2C',
                            'UMFUTURE_MARGIN',
                            'CMFUTURE_MAIN',
                            'CMFUTURE_MARGIN',
                            'MARGIN_MAIN',
                            'MARGIN_UMFUTURE',
                            'MARGIN_CMFUTURE',
                            'MARGIN_MINING',
                            'MARGIN_C2C',
                            'MINING_MAIN',
                            'MINING_UMFUTURE',
                            'MINING_C2C',
                            'MINING_MARGIN',
                            'MAIN_PAY',
                            'PAY_MAIN',
                            'ISOLATEDMARGIN_MARGIN',
                            'MARGIN_ISOLATEDMARGIN',
                            'ISOLATEDMARGIN_ISOLATEDMARGIN',
                        ],
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'from_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
                    ],
                    'to_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_asset_get_funding_asset' => [
                'class' => BinancePostSapiV1AssetGetFundingAsset::class,
                'name' => 'Funding Wallet (USER_DATA)',
                'description' => 'Funding Wallet (USER_DATA)

- Currently supports querying the following business assets：Binance Pay, Binance Card, Binance Gift Card, Stock Token Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/asset/get-funding-asset.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'need_btc_valuation' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `needBtcValuation`.',
                        'enum' => [
                            'true',
                            'false',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v3_asset_getuserasset' => [
                'class' => BinancePostSapiV3AssetGetuserasset::class,
                'name' => 'User Asset (USER_DATA)',
                'description' => 'User Asset (USER_DATA)

Get user assets, just for positive data. Weight(IP): 5

Official Binance Spot endpoint: POST /sapi/v3/asset/getUserAsset.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'need_btc_valuation' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `needBtcValuation`.',
                        'enum' => [
                            'true',
                            'false',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_asset_convert_transfer' => [
                'class' => BinancePostSapiV1AssetConvertTransfer::class,
                'name' => 'Convert Transfer (USER_DATA)',
                'description' => 'Convert Transfer (USER_DATA)

Convert transfer, convert between BUSD and stablecoins. If the clientId has been used before, will not do the convert transfer, the original transfer will be returned. Weight(UID): 5

Official Binance Spot endpoint: POST /sapi/v1/asset/convert-transfer.',
                'parameters' => [
                    'client_tran_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique flag, the min length is 20',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'target_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Target asset you want to convert',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_convert_transfer_querybypage' => [
                'class' => BinanceGetSapiV1AssetConvertTransferQuerybypage::class,
                'name' => 'Query Convert Transfer (USER_DATA)',
                'description' => 'Query Convert Transfer (USER_DATA)

Weight(UID): 5

Official Binance Spot endpoint: GET /sapi/v1/asset/convert-transfer/queryByPage.',
                'parameters' => [
                    'tran_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The transaction id',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'If it is blank, we will match deducted asset and target asset.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'account_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'MAIN: main account. CARD: funding account. If it is blank, we will query spot and card wallet, otherwise, we just query the corresponding wallet',
                        'enum' => [
                            'MAIN',
                            'CARD',
                        ],
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_ledger_transfer_cloud_mining_querybypage' => [
                'class' => BinanceGetSapiV1AssetLedgerTransferCloudMiningQuerybypage::class,
                'name' => 'Get Cloud-Mining payment and refund history (USER_DATA)',
                'description' => 'Get Cloud-Mining payment and refund history (USER_DATA)

The query of Cloud-Mining payment and refund history Weight(UID): 600

Official Binance Spot endpoint: GET /sapi/v1/asset/ledger-transfer/cloud-mining/queryByPage.',
                'parameters' => [
                    'tran_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The transaction id',
                    ],
                    'client_tran_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The unique flag',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'If it is blank, we will query all assets',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_account_apirestrictions' => [
                'class' => BinanceGetSapiV1AccountApirestrictions::class,
                'name' => 'Get API Key Permission (USER_DATA)',
                'description' => 'Get API Key Permission (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/account/apiRestrictions.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_contract_convertible_coins' => [
                'class' => BinanceGetSapiV1CapitalContractConvertibleCoins::class,
                'name' => 'Query auto-converting stable coins (USER_DATA)',
                'description' => 'Query auto-converting stable coins (USER_DATA)

Get a user\'s auto-conversion settings in deposit/withdrawal Weight(UID): 600\'

Official Binance Spot endpoint: GET /sapi/v1/capital/contract/convertible-coins.',
                'parameters' => [],
            ],
            'binance_post_sapi_v1_capital_contract_convertible_coins' => [
                'class' => BinancePostSapiV1CapitalContractConvertibleCoins::class,
                'name' => 'Switch on/off BUSD and stable coins conversion (USER_DATA) (USER_DATA)',
                'description' => 'Switch on/off BUSD and stable coins conversion (USER_DATA) (USER_DATA)

User can use it to turn on or turn off the BUSD auto-conversion from/to a specific stable coin. Weight(UID): 600\'

Official Binance Spot endpoint: POST /sapi/v1/capital/contract/convertible-coins.',
                'parameters' => [
                    'coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Must be USDC, USDP or TUSD',
                    ],
                    'enable' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'true: turn on the auto-conversion. false: turn off the auto-conversion',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_virtualsubaccount' => [
                'class' => BinancePostSapiV1SubAccountVirtualsubaccount::class,
                'name' => 'Create a Virtual Sub-account(For Master Account)',
                'description' => 'Create a Virtual Sub-account(For Master Account)

- This request will generate a virtual sub account under your master account. - You need to enable "trade" option for the api key which requests this endpoint. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/virtualSubAccount.',
                'parameters' => [
                    'sub_account_string' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Please input a string. We will create a virtual email using that string for you to register',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_list' => [
                'class' => BinanceGetSapiV1SubAccountList::class,
                'name' => 'Query Sub-account List (For Master Account)',
                'description' => 'Query Sub-account List (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/list.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'is_freeze' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `isFreeze`.',
                        'enum' => [
                            'true',
                            'false',
                        ],
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1; max 200',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_sub_transfer_history' => [
                'class' => BinanceGetSapiV1SubAccountSubTransferHistory::class,
                'name' => 'Sub-account Spot Asset Transfer History (For Master Account)',
                'description' => 'Sub-account Spot Asset Transfer History (For Master Account)

- fromEmail and toEmail cannot be sent at the same time. - Return fromEmail equal master account email by default. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/sub/transfer/history.',
                'parameters' => [
                    'from_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'to_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_futures_internaltransfer' => [
                'class' => BinanceGetSapiV1SubAccountFuturesInternaltransfer::class,
                'name' => 'Sub-account Futures Asset Transfer History (For Master Account)',
                'description' => 'Sub-account Futures Asset Transfer History (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/futures/internalTransfer.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'futures_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '1:USDT-margined Futures, 2: Coin-margined Futures',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default value: 50, Max value: 500',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_futures_internaltransfer' => [
                'class' => BinancePostSapiV1SubAccountFuturesInternaltransfer::class,
                'name' => 'Sub-account Futures Asset Transfer (For Master Account)',
                'description' => 'Sub-account Futures Asset Transfer (For Master Account)

- Master account can transfer max 2000 times a minute Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/futures/internalTransfer.',
                'parameters' => [
                    'from_email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sender email',
                    ],
                    'to_email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Recipient email',
                    ],
                    'futures_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '1:USDT-margined Futures,2: Coin-margined Futures',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v3_sub_account_assets' => [
                'class' => BinanceGetSapiV3SubAccountAssets::class,
                'name' => 'Sub-account Assets (For Master Account)',
                'description' => 'Sub-account Assets (For Master Account)

Fetch sub-account assets Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v3/sub-account/assets.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_spotsummary' => [
                'class' => BinanceGetSapiV1SubAccountSpotsummary::class,
                'name' => 'Sub-account Spot Assets Summary (For Master Account)',
                'description' => 'Sub-account Spot Assets Summary (For Master Account)

Get BTC valued asset summary of subaccounts. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/spotSummary.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:20',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_deposit_subaddress' => [
                'class' => BinanceGetSapiV1CapitalDepositSubaddress::class,
                'name' => 'Sub-account Spot Assets Summary (For Master Account)',
                'description' => 'Sub-account Spot Assets Summary (For Master Account)

Fetch sub-account deposit address Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/subAddress.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin name',
                    ],
                    'network' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `network`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_deposit_subhisrec' => [
                'class' => BinanceGetSapiV1CapitalDepositSubhisrec::class,
                'name' => 'Sub-account Deposit History (For Master Account)',
                'description' => 'Sub-account Deposit History (For Master Account)

Fetch sub-account deposit history Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/subHisrec.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin name',
                    ],
                    'status' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => '0(0:pending,6: credited but cannot withdraw, 1:success)',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `limit`.',
                    ],
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `offset`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_capital_deposit_credit_apply' => [
                'class' => BinancePostSapiV1CapitalDepositCreditApply::class,
                'name' => 'One click arrival deposit apply (USER_DATA)',
                'description' => 'One click arrival deposit apply (USER_DATA)

Apply deposit credit for expired address (One click arrival) Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/capital/deposit/credit-apply.',
                'parameters' => [
                    'deposit_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Deposit record Id, priority use',
                    ],
                    'tx_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Deposit txId, used when depositId is not specified',
                    ],
                    'sub_account_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `subAccountId`.',
                    ],
                    'sub_user_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `subUserId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_wallet_balance' => [
                'class' => BinanceGetSapiV1AssetWalletBalance::class,
                'name' => 'Query User Wallet Balance (USER_DATA)',
                'description' => 'Query User Wallet Balance (USER_DATA)

Query User Wallet Balance Weight(IP): 60

Official Binance Spot endpoint: GET /sapi/v1/asset/wallet/balance.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_asset_custody_transfer_history' => [
                'class' => BinanceGetSapiV1AssetCustodyTransferHistory::class,
                'name' => 'Query User Delegation History(For Master Account) (USER_DATA)',
                'description' => 'Query User Delegation History(For Master Account) (USER_DATA)

Query User Delegation History Weight(IP): 60

Official Binance Spot endpoint: GET /sapi/v1/asset/custody/transfer-history.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `startTime`.',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `endTime`.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `type`.',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_deposit_address_list' => [
                'class' => BinanceGetSapiV1CapitalDepositAddressList::class,
                'name' => 'Fetch deposit address list with network (USER_DATA)',
                'description' => 'Fetch deposit address list with network (USER_DATA)

Fetch deposit address list with network. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/address/list.',
                'parameters' => [
                    'coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `coin`.',
                    ],
                    'network' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `network`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_spot_delist_schedule' => [
                'class' => BinanceGetSapiV1SpotDelistSchedule::class,
                'name' => 'Get symbols delist schedule for spot (MARKET_DATA)',
                'description' => 'Get symbols delist schedule for spot (MARKET_DATA)

Get symbols delist schedule for spot Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/spot/delist-schedule.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_capital_withdraw_address_list' => [
                'class' => BinanceGetSapiV1CapitalWithdrawAddressList::class,
                'name' => 'Fetch withdraw address list (USER_DATA)',
                'description' => 'Fetch withdraw address list (USER_DATA)

Fetch withdraw address list Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/withdraw/address/list.',
                'parameters' => [],
            ],
            'binance_get_sapi_v1_account_info' => [
                'class' => BinanceGetSapiV1AccountInfo::class,
                'name' => 'Account info (USER_DATA)',
                'description' => 'Account info (USER_DATA)

Fetch account info detail. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/account/info.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_status' => [
                'class' => BinanceGetSapiV1SubAccountStatus::class,
                'name' => 'Sub-account\'s Status on Margin/Futures (For Master Account)',
                'description' => 'Sub-account\'s Status on Margin/Futures (For Master Account)

- If no `email` sent, all sub-accounts\' information will be returned. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/status.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_margin_enable' => [
                'class' => BinancePostSapiV1SubAccountMarginEnable::class,
                'name' => 'Enable Margin for Sub-account (For Master Account)',
                'description' => 'Enable Margin for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/margin/enable.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_margin_account' => [
                'class' => BinanceGetSapiV1SubAccountMarginAccount::class,
                'name' => 'Detail on Sub-account\'s Margin Account (For Master Account)',
                'description' => 'Detail on Sub-account\'s Margin Account (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/margin/account.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_margin_accountsummary' => [
                'class' => BinanceGetSapiV1SubAccountMarginAccountsummary::class,
                'name' => 'Summary of Sub-account\'s Margin Account (For Master Account)',
                'description' => 'Summary of Sub-account\'s Margin Account (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/margin/accountSummary.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_futures_enable' => [
                'class' => BinancePostSapiV1SubAccountFuturesEnable::class,
                'name' => 'Enable Futures for Sub-account (For Master Account)',
                'description' => 'Enable Futures for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/futures/enable.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_futures_account' => [
                'class' => BinanceGetSapiV1SubAccountFuturesAccount::class,
                'name' => 'Detail on Sub-account\'s Futures Account (For Master Account)',
                'description' => 'Detail on Sub-account\'s Futures Account (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/futures/account.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_futures_accountsummary' => [
                'class' => BinanceGetSapiV1SubAccountFuturesAccountsummary::class,
                'name' => 'Summary of Sub-account\'s Futures Account (For Master Account)',
                'description' => 'Summary of Sub-account\'s Futures Account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/futures/accountSummary.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_futures_positionrisk' => [
                'class' => BinanceGetSapiV1SubAccountFuturesPositionrisk::class,
                'name' => 'Futures Position-Risk of Sub-account (For Master Account)',
                'description' => 'Futures Position-Risk of Sub-account (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/futures/positionRisk.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_futures_transfer' => [
                'class' => BinancePostSapiV1SubAccountFuturesTransfer::class,
                'name' => 'Transfer for Sub-account (For Master Account)',
                'description' => 'Transfer for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/futures/transfer.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '* `1` - transfer from subaccount\'s spot account to its USDT-margined futures account * `2` - transfer from subaccount\'s USDT-margined futures account to its spot account * `3` - transfer from subaccount\'s spot account to its COIN-margined futures account * `4` - transfer from subaccount\'s COIN-margined futures account to its spot account',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_margin_transfer' => [
                'class' => BinancePostSapiV1SubAccountMarginTransfer::class,
                'name' => 'Margin Transfer for Sub-account (For Master Account)',
                'description' => 'Margin Transfer for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/margin/transfer.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '* `1` - transfer from subaccount\'s spot account to margin account * `2` - transfer from subaccount\'s margin account to its spot account',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_transfer_subtosub' => [
                'class' => BinancePostSapiV1SubAccountTransferSubtosub::class,
                'name' => 'Transfer to Sub-account of Same Master (For Sub-account)',
                'description' => 'Transfer to Sub-account of Same Master (For Sub-account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/transfer/subToSub.',
                'parameters' => [
                    'to_email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Recipient email',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_transfer_subtomaster' => [
                'class' => BinancePostSapiV1SubAccountTransferSubtomaster::class,
                'name' => 'Transfer to Master (For Sub-account)',
                'description' => 'Transfer to Master (For Sub-account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/transfer/subToMaster.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_transfer_subuserhistory' => [
                'class' => BinanceGetSapiV1SubAccountTransferSubuserhistory::class,
                'name' => 'Sub-account Transfer History (For Sub-account)',
                'description' => 'Sub-account Transfer History (For Sub-account)

- If `type` is not sent, the records of type 2: transfer out will be returned by default. - If `startTime` and `endTime` are not sent, the recent 30-day data will be returned. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/transfer/subUserHistory.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => '* `1` - transfer in * `2` - transfer out',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_universaltransfer' => [
                'class' => BinanceGetSapiV1SubAccountUniversaltransfer::class,
                'name' => 'Universal Transfer History (For Master Account)',
                'description' => 'Universal Transfer History (For Master Account)

- `fromEmail` and `toEmail` cannot be sent at the same time. - Return `fromEmail` equal master account email by default. - The query time period must be less then 30 days. - If startTime and endTime not sent, return records of the last 30 days by default. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/universalTransfer.',
                'parameters' => [
                    'from_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'to_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'client_tran_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `clientTranId`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500, Max 500',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_universaltransfer' => [
                'class' => BinancePostSapiV1SubAccountUniversaltransfer::class,
                'name' => 'Universal Transfer (For Master Account)',
                'description' => 'Universal Transfer (For Master Account)

- You need to enable "internal transfer" option for the api key which requests this endpoint. - Transfer from master account by default if fromEmail is not sent. - Transfer to master account by default if toEmail is not sent. - Supported transfer scenarios: - Master account SPOT transfer to sub-account SPOT,USDT_FUTURE,COIN_FUTURE,MARGIN(Cross),ISOLATED_MARGIN - Sub-account SPOT,USDT_FUTURE,COIN_FUTURE,MARGIN(Cross),ISOLATED_MARGIN transfer to master account SPOT - Transfer between two sub-account SPOT accounts Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/universalTransfer.',
                'parameters' => [
                    'from_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'to_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sub-account email',
                    ],
                    'from_account_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `fromAccountType`.',
                        'enum' => [
                            'SPOT',
                            'USDT_FUTURE',
                            'COIN_FUTURE',
                            'MARGIN',
                            'ISOLATED_MARGIN',
                        ],
                    ],
                    'to_account_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `toAccountType`.',
                        'enum' => [
                            'SPOT',
                            'USDT_FUTURE',
                            'COIN_FUTURE',
                            'MARGIN',
                            'ISOLATED_MARGIN',
                        ],
                    ],
                    'client_tran_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `clientTranId`.',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only supported under ISOLATED_MARGIN type',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_sub_account_futures_account' => [
                'class' => BinanceGetSapiV2SubAccountFuturesAccount::class,
                'name' => 'Detail on Sub-account\'s Futures Account V2 (For Master Account)',
                'description' => 'Detail on Sub-account\'s Futures Account V2 (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v2/sub-account/futures/account.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'futures_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '* `1` - USDT Margined Futures * `2` - COIN Margined Futures',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_sub_account_futures_accountsummary' => [
                'class' => BinanceGetSapiV2SubAccountFuturesAccountsummary::class,
                'name' => 'Summary of Sub-account\'s Futures Account V2 (For Master Account)',
                'description' => 'Summary of Sub-account\'s Futures Account V2 (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v2/sub-account/futures/accountSummary.',
                'parameters' => [
                    'futures_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '* `1` - USDT Margined Futures * `2` - COIN Margined Futures',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 10, Max 20',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_sub_account_futures_positionrisk' => [
                'class' => BinanceGetSapiV2SubAccountFuturesPositionrisk::class,
                'name' => 'Futures Position-Risk of Sub-account V2 (For Master Account)',
                'description' => 'Futures Position-Risk of Sub-account V2 (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v2/sub-account/futures/positionRisk.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'futures_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '* `1` - USDT Margined Futures * `2` - COIN Margined Futures',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_blvt_enable' => [
                'class' => BinancePostSapiV1SubAccountBlvtEnable::class,
                'name' => 'Enable Leverage Token for Sub-account (For Master Account)',
                'description' => 'Enable Leverage Token for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/blvt/enable.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'enable_blvt' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'Only true for now',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_managed_subaccount_deposit' => [
                'class' => BinancePostSapiV1ManagedSubaccountDeposit::class,
                'name' => 'Deposit assets into the managed sub-account(For Investor Master Account)',
                'description' => 'Deposit assets into the managed sub-account(For Investor Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/managed-subaccount/deposit.',
                'parameters' => [
                    'to_email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Recipient email',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_asset' => [
                'class' => BinanceGetSapiV1ManagedSubaccountAsset::class,
                'name' => 'Managed sub-account asset details(For Investor Master Account)',
                'description' => 'Managed sub-account asset details(For Investor Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/asset.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_managed_subaccount_withdraw' => [
                'class' => BinancePostSapiV1ManagedSubaccountWithdraw::class,
                'name' => 'Withdrawl assets from the managed sub-account(For Investor Master Account)',
                'description' => 'Withdrawl assets from the managed sub-account(For Investor Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/managed-subaccount/withdraw.',
                'parameters' => [
                    'from_email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sender email',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'transfer_date' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Withdrawals is automatically occur on the transfer date(UTC0). If a date is not selected, the withdrawal occurs right now',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_accountsnapshot' => [
                'class' => BinanceGetSapiV1ManagedSubaccountAccountsnapshot::class,
                'name' => 'Managed sub-account snapshot (For Investor Master Account)',
                'description' => 'Managed sub-account snapshot (For Investor Master Account)

- The query time period must be less then 30 days - Support query within the last one month only - If `startTime` and `endTime` not sent, return records of the last 7 days by default Weight(IP): 2400

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/accountSnapshot.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => '"SPOT", "MARGIN"(cross), "FUTURES"(UM)',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'min 7, max 30, default 7',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_querytranslogforinvestor' => [
                'class' => BinanceGetSapiV1ManagedSubaccountQuerytranslogforinvestor::class,
                'name' => 'Query Managed Sub Account Transfer Log (For Investor Master Account)',
                'description' => 'Query Managed Sub Account Transfer Log (For Investor Master Account)

Investor can use this api to query managed sub account transfer log. This endpoint is available for investor of Managed Sub-Account. A Managed Sub-Account is an account type for investors who value flexibility in asset allocation and account application, while delegating trades to a professional trading team. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/queryTransLogForInvestor.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'transfers' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Transfer Direction (FROM/TO)',
                    ],
                    'transfer_function_account_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Transfer function account type (SPOT/MARGIN/ISOLATED_MARGIN/USDT_FUTURE/COIN_FUTURE)',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_querytranslogfortradeparent' => [
                'class' => BinanceGetSapiV1ManagedSubaccountQuerytranslogfortradeparent::class,
                'name' => 'Query Managed Sub Account Transfer Log (For Trading Team Master Account)',
                'description' => 'Query Managed Sub Account Transfer Log (For Trading Team Master Account)

Trading team can use this api to query managed sub account transfer log. This endpoint is available for trading team of Managed Sub-Account. A Managed Sub-Account is an account type for investors who value flexibility in asset allocation and account application, while delegating trades to a professional trading team Weight(IP): 60

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/queryTransLogForTradeParent.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'transfers' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Transfer Direction (FROM/TO)',
                    ],
                    'transfer_function_account_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Transfer function account type (SPOT/MARGIN/ISOLATED_MARGIN/USDT_FUTURE/COIN_FUTURE)',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_fetch_future_asset' => [
                'class' => BinanceGetSapiV1ManagedSubaccountFetchFutureAsset::class,
                'name' => 'Query Managed Sub-account Futures Asset Details (For Investor Master Account)',
                'description' => 'Query Managed Sub-account Futures Asset Details (For Investor Master Account)

Investor can use this api to query managed sub account futures asset details

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/fetch-future-asset.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_marginasset' => [
                'class' => BinanceGetSapiV1ManagedSubaccountMarginasset::class,
                'name' => 'Query Managed Sub-account Margin Asset Details (For Investor Master Account)',
                'description' => 'Query Managed Sub-account Margin Asset Details (For Investor Master Account)

Investor can use this api to query managed sub account margin asset details

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/marginAsset.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_info' => [
                'class' => BinanceGetSapiV1ManagedSubaccountInfo::class,
                'name' => 'Query Managed Sub-account List (For Investor)',
                'description' => 'Query Managed Sub-account List (For Investor)

Get investor\'s managed sub-account list. Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/info.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_deposit_address' => [
                'class' => BinanceGetSapiV1ManagedSubaccountDepositAddress::class,
                'name' => 'Get Managed Sub-account Deposit Address (For Investor Master Account)',
                'description' => 'Get Managed Sub-account Deposit Address (For Investor Master Account)

Get investor\'s managed sub-account deposit address Weight(UID): 1

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/deposit/address.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin name',
                    ],
                    'network' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `network`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_managed_subaccount_query_trans_log' => [
                'class' => BinanceGetSapiV1ManagedSubaccountQueryTransLog::class,
                'name' => 'Query Managed Sub Account Transfer Log (For Trading Team Sub Account)(USER_DATA)',
                'description' => 'Query Managed Sub Account Transfer Log (For Trading Team Sub Account)(USER_DATA)

Query Managed Sub Account Transfer Log (For Trading Team Sub Account) Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/query-trans-log.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'transfers' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Transfer Direction',
                        'enum' => [
                            'FROM',
                            'TO',
                        ],
                    ],
                    'transfer_function_account_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Transfer function account type',
                        'enum' => [
                            'SPOT',
                            'MARGIN',
                            'ISOLATED_MARGIN',
                            'USDT_FUTURE',
                            'COIN_FUTURE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_subaccountapi_iprestriction' => [
                'class' => BinanceGetSapiV1SubAccountSubaccountapiIprestriction::class,
                'name' => 'Get IP Restriction for a Sub-account API Key (For Master Account)',
                'description' => 'Get IP Restriction for a Sub-account API Key (For Master Account)

Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/sub-account/subAccountApi/ipRestriction.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'sub_account_api_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `subAccountApiKey`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_sub_account_subaccountapi_iprestriction_iplist' => [
                'class' => BinanceDeleteSapiV1SubAccountSubaccountapiIprestrictionIplist::class,
                'name' => 'Delete IP List for a Sub-account API Key (For Master Account)',
                'description' => 'Delete IP List for a Sub-account API Key (For Master Account)

Weight(UID): 3000

Official Binance Spot endpoint: DELETE /sapi/v1/sub-account/subAccountApi/ipRestriction/ipList.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'sub_account_api_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `subAccountApiKey`.',
                    ],
                    'ip_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Can be added in batches, separated by commas',
                    ],
                    'third_party_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'third party IP list name',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_sub_account_transaction_statistics' => [
                'class' => BinanceGetSapiV1SubAccountTransactionStatistics::class,
                'name' => 'Query Sub-account Transaction Statistics (For Master Account)',
                'description' => 'Query Sub-account Transaction Statistics (For Master Account)

Query Sub-account Transaction statistics (For Master Account). Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v1/sub-account/transaction-statistics.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_sub_account_eoptions_enable' => [
                'class' => BinancePostSapiV1SubAccountEoptionsEnable::class,
                'name' => 'Enable Options for Sub-account (For Master Account)(USER_DATA)',
                'description' => 'Enable Options for Sub-account (For Master Account)(USER_DATA)

Enable Options for Sub-account (For Master Account). Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/eoptions/enable.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v2_sub_account_subaccountapi_iprestriction' => [
                'class' => BinancePostSapiV2SubAccountSubaccountapiIprestriction::class,
                'name' => 'Update IP Restriction for Sub-Account API key (For Master Account)',
                'description' => 'Update IP Restriction for Sub-Account API key (For Master Account)

Update IP Restriction for Sub-Account API key Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v2/sub-account/subAccountApi/ipRestriction.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Sub-account email',
                    ],
                    'sub_account_api_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `subAccountApiKey`.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'IP Restriction status. 1 = IP Unrestricted. 2 = Restrict access to trusted IPs only. 3 = Restrict access to users\' trusted third party IPs only',
                    ],
                    'third_party_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'third party IP list name',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v4_sub_account_assets' => [
                'class' => BinanceGetSapiV4SubAccountAssets::class,
                'name' => 'Query Sub-account Assets (For Master Account)',
                'description' => 'Query Sub-account Assets (For Master Account)

Fetch sub-account assets Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v4/sub-account/assets.',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `email`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_api_v3_userdatastream' => [
                'class' => BinancePostApiV3Userdatastream::class,
                'name' => 'Create a ListenKey (USER_STREAM)',
                'description' => 'Create a ListenKey (USER_STREAM)

Start a new user data stream. The stream will close after 60 minutes unless a keepalive is sent. If the account has an active `listenKey`, that `listenKey` will be returned and its validity will be extended for 60 minutes. Weight: 2

Official Binance Spot endpoint: POST /api/v3/userDataStream.',
                'parameters' => [],
            ],
            'binance_put_api_v3_userdatastream' => [
                'class' => BinancePutApiV3Userdatastream::class,
                'name' => 'Ping/Keep-alive a ListenKey (USER_STREAM)',
                'description' => 'Ping/Keep-alive a ListenKey (USER_STREAM)

Keepalive a user data stream to prevent a time out. User data streams will close after 60 minutes. It\'s recommended to send a ping about every 30 minutes. Weight: 2

Official Binance Spot endpoint: PUT /api/v3/userDataStream.',
                'parameters' => [
                    'listen_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User websocket listen key',
                    ],
                ],
            ],
            'binance_delete_api_v3_userdatastream' => [
                'class' => BinanceDeleteApiV3Userdatastream::class,
                'name' => 'Close a ListenKey (USER_STREAM)',
                'description' => 'Close a ListenKey (USER_STREAM)

Close out a user data stream. Weight: 2

Official Binance Spot endpoint: DELETE /api/v3/userDataStream.',
                'parameters' => [
                    'listen_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User websocket listen key',
                    ],
                ],
            ],
            'binance_post_sapi_v1_userdatastream' => [
                'class' => BinancePostSapiV1Userdatastream::class,
                'name' => 'Create a ListenKey (USER_STREAM)',
                'description' => 'Create a ListenKey (USER_STREAM)

Start a new user data stream. The stream will close after 60 minutes unless a keepalive is sent. If the account has an active `listenKey`, that `listenKey` will be returned and its validity will be extended for 60 minutes. Weight: 1

Official Binance Spot endpoint: POST /sapi/v1/userDataStream.',
                'parameters' => [],
            ],
            'binance_put_sapi_v1_userdatastream' => [
                'class' => BinancePutSapiV1Userdatastream::class,
                'name' => 'Ping/Keep-alive a ListenKey (USER_STREAM)',
                'description' => 'Ping/Keep-alive a ListenKey (USER_STREAM)

Keepalive a user data stream to prevent a time out. User data streams will close after 60 minutes. It\'s recommended to send a ping about every 30 minutes. Weight: 1

Official Binance Spot endpoint: PUT /sapi/v1/userDataStream.',
                'parameters' => [
                    'listen_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User websocket listen key',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_userdatastream' => [
                'class' => BinanceDeleteSapiV1Userdatastream::class,
                'name' => 'Close a ListenKey (USER_STREAM)',
                'description' => 'Close a ListenKey (USER_STREAM)

Close out a user data stream. Weight: 1

Official Binance Spot endpoint: DELETE /sapi/v1/userDataStream.',
                'parameters' => [
                    'listen_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User websocket listen key',
                    ],
                ],
            ],
            'binance_post_sapi_v1_userdatastream_isolated' => [
                'class' => BinancePostSapiV1UserdatastreamIsolated::class,
                'name' => 'Generate a Listen Key (USER_STREAM)',
                'description' => 'Generate a Listen Key (USER_STREAM)

Start a new user data stream. The stream will close after 60 minutes unless a keepalive is sent. If the account has an active `listenKey`, that `listenKey` will be returned and its validity will be extended for 60 minutes. Weight: 1

Official Binance Spot endpoint: POST /sapi/v1/userDataStream/isolated.',
                'parameters' => [],
            ],
            'binance_put_sapi_v1_userdatastream_isolated' => [
                'class' => BinancePutSapiV1UserdatastreamIsolated::class,
                'name' => 'Ping/Keep-alive a Listen Key (USER_STREAM)',
                'description' => 'Ping/Keep-alive a Listen Key (USER_STREAM)

Keepalive a user data stream to prevent a time out. User data streams will close after 60 minutes. It\'s recommended to send a ping about every 30 minutes. Weight: 1

Official Binance Spot endpoint: PUT /sapi/v1/userDataStream/isolated.',
                'parameters' => [
                    'listen_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User websocket listen key',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_userdatastream_isolated' => [
                'class' => BinanceDeleteSapiV1UserdatastreamIsolated::class,
                'name' => 'Close a ListenKey (USER_STREAM)',
                'description' => 'Close a ListenKey (USER_STREAM)

Close out a user data stream. Weight: 1

Official Binance Spot endpoint: DELETE /sapi/v1/userDataStream/isolated.',
                'parameters' => [
                    'listen_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User websocket listen key',
                    ],
                ],
            ],
            'binance_get_sapi_v1_fiat_orders' => [
                'class' => BinanceGetSapiV1FiatOrders::class,
                'name' => 'Fiat Deposit/Withdraw History (USER_DATA)',
                'description' => 'Fiat Deposit/Withdraw History (USER_DATA)

- If beginTime and endTime are not sent, the recent 30-day data will be returned. Weight(UID): 90000

Official Binance Spot endpoint: GET /sapi/v1/fiat/orders.',
                'parameters' => [
                    'transaction_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '* `0` - deposit * `1` - withdraw',
                    ],
                    'begin_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `beginTime`.',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'rows' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 100, max 500',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_fiat_payments' => [
                'class' => BinanceGetSapiV1FiatPayments::class,
                'name' => 'Fiat Payments History (USER_DATA)',
                'description' => 'Fiat Payments History (USER_DATA)

- If beginTime and endTime are not sent, the recent 30-day data will be returned. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/fiat/payments.',
                'parameters' => [
                    'transaction_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '* `0` - deposit * `1` - withdraw',
                    ],
                    'begin_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `beginTime`.',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'rows' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 100, max 500',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_project_list' => [
                'class' => BinanceGetSapiV1LendingProjectList::class,
                'name' => 'Get Fixed/Activity Project List(USER_DATA)',
                'description' => 'Get Fixed/Activity Project List(USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/project/list.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'ACTIVITY',
                            'CUSTOMIZED_FIXED',
                        ],
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default `ALL`',
                        'enum' => [
                            'ALL',
                            'SUBSCRIBABLE',
                            'UNSUBSCRIBABLE',
                        ],
                    ],
                    'is_sort_asc' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'default "true"',
                    ],
                    'sort_by' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default `START_TIME`',
                        'enum' => [
                            'START_TIME',
                            'LOT_SIZE',
                            'INTEREST_RATE',
                            'DURATION',
                        ],
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_lending_customizedfixed_purchase' => [
                'class' => BinancePostSapiV1LendingCustomizedfixedPurchase::class,
                'name' => 'Purchase Fixed/Activity Project (USER_DATA)',
                'description' => 'Purchase Fixed/Activity Project (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/customizedFixed/purchase.',
                'parameters' => [
                    'project_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `projectId`.',
                    ],
                    'lot' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `lot`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_project_position_list' => [
                'class' => BinanceGetSapiV1LendingProjectPositionList::class,
                'name' => 'Get Fixed/Activity Project Position (USER_DATA)',
                'description' => 'Get Fixed/Activity Project Position (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/project/position/list.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'project_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `projectId`.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default `ALL`',
                        'enum' => [
                            'ALL',
                            'SUBSCRIBABLE',
                            'UNSUBSCRIBABLE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_lending_positionchanged' => [
                'class' => BinancePostSapiV1LendingPositionchanged::class,
                'name' => 'Change Fixed/Activity Position to Daily Position (USER_DATA)',
                'description' => 'Change Fixed/Activity Position to Daily Position (USER_DATA)

- PositionId is mandatory parameter for fixed position. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/positionChanged.',
                'parameters' => [
                    'project_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `projectId`.',
                    ],
                    'lot' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `lot`.',
                    ],
                    'position_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `positionId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_pub_algolist' => [
                'class' => BinanceGetSapiV1MiningPubAlgolist::class,
                'name' => 'Acquiring Algorithm (MARKET_DATA)',
                'description' => 'Acquiring Algorithm (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/mining/pub/algoList.',
                'parameters' => [],
            ],
            'binance_get_sapi_v1_mining_pub_coinlist' => [
                'class' => BinanceGetSapiV1MiningPubCoinlist::class,
                'name' => 'Acquiring CoinName (MARKET_DATA)',
                'description' => 'Acquiring CoinName (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/mining/pub/coinList.',
                'parameters' => [],
            ],
            'binance_get_sapi_v1_mining_worker_detail' => [
                'class' => BinanceGetSapiV1MiningWorkerDetail::class,
                'name' => 'Request for Detail Miner List (USER_DATA)',
                'description' => 'Request for Detail Miner List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/worker/detail.',
                'parameters' => [
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'worker_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Miner’s name',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_worker_list' => [
                'class' => BinanceGetSapiV1MiningWorkerList::class,
                'name' => 'Request for Miner List (USER_DATA)',
                'description' => 'Request for Miner List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/worker/list.',
                'parameters' => [
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'sort' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'sort sequence(default=0)0 positive sequence, 1 negative sequence',
                    ],
                    'sort_column' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Sort by( default 1): 1: miner name, 2: real-time computing power, 3: daily average computing power, 4: real-time rejection rate, 5: last submission time',
                    ],
                    'worker_status' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'miners status(default=0)0 all, 1 valid, 2 invalid, 3 failure',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_payment_list' => [
                'class' => BinanceGetSapiV1MiningPaymentList::class,
                'name' => 'Earnings List (USER_DATA)',
                'description' => 'Earnings List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/payment/list.',
                'parameters' => [
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin name',
                    ],
                    'start_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'end_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of pages, minimum 10, maximum 200',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_payment_other' => [
                'class' => BinanceGetSapiV1MiningPaymentOther::class,
                'name' => 'Extra Bonus List (USER_DATA)',
                'description' => 'Extra Bonus List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/payment/other.',
                'parameters' => [
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin name',
                    ],
                    'start_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'end_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of pages, minimum 10, maximum 200',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_hash_transfer_config_details_list' => [
                'class' => BinanceGetSapiV1MiningHashTransferConfigDetailsList::class,
                'name' => 'Hashrate Resale List (USER_DATA)',
                'description' => 'Hashrate Resale List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/hash-transfer/config/details/list.',
                'parameters' => [
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of pages, minimum 10, maximum 200',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_hash_transfer_profit_details' => [
                'class' => BinanceGetSapiV1MiningHashTransferProfitDetails::class,
                'name' => 'Hashrate Resale Details (USER_DATA)',
                'description' => 'Hashrate Resale Details (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/hash-transfer/profit/details.',
                'parameters' => [
                    'config_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining ID',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of pages, minimum 10, maximum 200',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_mining_hash_transfer_config' => [
                'class' => BinancePostSapiV1MiningHashTransferConfig::class,
                'name' => 'Hashrate Resale Request (USER_DATA)',
                'description' => 'Hashrate Resale Request (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: POST /sapi/v1/mining/hash-transfer/config.',
                'parameters' => [
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'start_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'end_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'to_pool_user' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'hash_rate' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Resale hashrate h/s must be transferred (BTC is greater than 500000000000 ETH is greater than 500000)',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_mining_hash_transfer_config_cancel' => [
                'class' => BinancePostSapiV1MiningHashTransferConfigCancel::class,
                'name' => 'Cancel Hashrate Resale configuration (USER_DATA)',
                'description' => 'Cancel Hashrate Resale configuration (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: POST /sapi/v1/mining/hash-transfer/config/cancel.',
                'parameters' => [
                    'config_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining ID',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_statistics_user_status' => [
                'class' => BinanceGetSapiV1MiningStatisticsUserStatus::class,
                'name' => 'Statistic List (USER_DATA)',
                'description' => 'Statistic List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/statistics/user/status.',
                'parameters' => [
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_statistics_user_list' => [
                'class' => BinanceGetSapiV1MiningStatisticsUserList::class,
                'name' => 'Account List (USER_DATA)',
                'description' => 'Account List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/statistics/user/list.',
                'parameters' => [
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'user_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Mining Account',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_mining_payment_uid' => [
                'class' => BinanceGetSapiV1MiningPaymentUid::class,
                'name' => 'Mining Account Earning (USER_DATA)',
                'description' => 'Mining Account Earning (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/payment/uid.',
                'parameters' => [
                    'algo' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Algorithm(sha256)',
                    ],
                    'start_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'end_date' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search date, millisecond timestamp, while empty query all',
                    ],
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Number of pages, minimum 10, maximum 200',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_futures_transfer' => [
                'class' => BinancePostSapiV1FuturesTransfer::class,
                'name' => 'New Future Account Transfer (USER_DATA)',
                'description' => 'New Future Account Transfer (USER_DATA)

Execute transfer between spot account and futures account. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/futures/transfer.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '1: transfer from spot account to USDT-Ⓜ futures account. 2: transfer from USDT-Ⓜ futures account to spot account. 3: transfer from spot account to COIN-Ⓜ futures account. 4: transfer from COIN-Ⓜ futures account to spot account.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_futures_transfer' => [
                'class' => BinanceGetSapiV1FuturesTransfer::class,
                'name' => 'Get Future Account Transaction History List (USER_DATA)',
                'description' => 'Get Future Account Transaction History List (USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/futures/transfer.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_futures_histdatalink' => [
                'class' => BinanceGetSapiV1FuturesHistdatalink::class,
                'name' => 'Get Future TickLevel Orderbook Historical Data Download Link (USER_DATA)',
                'description' => 'Get Future TickLevel Orderbook Historical Data Download Link (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/futures/histDataLink.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `symbol`.',
                    ],
                    'data_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `dataType`.',
                        'enum' => [
                            'T_DEPTH',
                            'S_DEPTH',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_algo_futures_newordervp' => [
                'class' => BinancePostSapiV1AlgoFuturesNewordervp::class,
                'name' => 'Volume Participation(VP) New Order (TRADE)',
                'description' => 'Volume Participation(VP) New Order (TRADE)

Send in a VP new order. Only support on USDⓈ-M Contracts. - You need to enable `Futures Trading Permission` for the api key which requests this endpoint. - Base URL: https://api.binance.com - Total Algo open orders max allowed: 10 orders. - Leverage of symbols and position mode will be the same as your futures account settings. You can set up through the trading page or fapi. - Receiving "success": true does not mean that your order will be executed. Please use the query order endpoints(GET sapi/v1/algo/futures/openOrders or GET sapi/v1/algo/futures/historicalOrders) to check the order status. For example: Your futures balance is insufficient, or open position with reduce only or position side is inconsistent with your own setting. In these cases you will receive "success": true, but the order status will be expired after we check it. Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/algo/futures/newOrderVp.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'position_side' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default BOTH for One-way Mode ; LONG or SHORT for Hedge Mode. It must be sent in Hedge Mode.',
                        'enum' => [
                            'BOTH',
                            'LONG',
                            'SHORT',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Quantity of base asset; The notional (quantity * mark price(base asset)) must be more than the equivalent of 10,000 USDT and less than the equivalent of 1,000,000 USDT',
                    ],
                    'urgency' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Represent the relative speed of the current execution; ENUM: LOW, MEDIUM, HIGH',
                        'enum' => [
                            'LOW',
                            'MEDIUM',
                            'HIGH',
                        ],
                    ],
                    'client_algo_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A unique id among Algo orders (length should be 32 characters)， If it is not sent, we will give default value',
                    ],
                    'reduce_only' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => '\'true\' or \'false\'. Default \'false\'; Cannot be sent in Hedge Mode; Cannot be sent when you open a position',
                    ],
                    'limit_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Limit price of the order; If it is not sent, will place order by market price by default',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_algo_futures_newordertwap' => [
                'class' => BinancePostSapiV1AlgoFuturesNewordertwap::class,
                'name' => 'Time-Weighted Average Price(Twap) New Order (TRADE)',
                'description' => 'Time-Weighted Average Price(Twap) New Order (TRADE)

Send in a Twap new order. Only support on USDⓈ-M Contracts. You need to enable Futures Trading Permission for the api key which requests this endpoint. Base URL: https://api.binance.com - Total Algo open orders max allowed: 10 orders. - Leverage of symbols and position mode will be the same as your futures account settings. You can set up through the trading page or fapi. - Receiving "success": true does not mean that your order will be executed. Please use the query order endpoints(GET sapi/v1/algo/futures/openOrders or GET sapi/v1/algo/futures/historicalOrders) to check the order status. For example: Your futures balance is insufficient, or open position with reduce only or position side is inconsistent with your own setting. In these cases you will receive "success": true, but the order status will be expired after we check it. - quantity * 60 / duration should be larger than minQty - duration cannot be less than 5 mins or more than 24 hours. - For delivery contracts, TWAP end time

Official Binance Spot endpoint: POST /sapi/v1/algo/futures/newOrderTwap.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'position_side' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default BOTH for One-way Mode ; LONG or SHORT for Hedge Mode. It must be sent in Hedge Mode.',
                        'enum' => [
                            'BOTH',
                            'LONG',
                            'SHORT',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Quantity of base asset; The notional (quantity * mark price(base asset)) must be more than the equivalent of 10,000 USDT and less than the equivalent of 1,000,000 USDT',
                    ],
                    'duration' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'Duration for TWAP orders in seconds. [300, 86400];Less than 5min => defaults to 5 min; Greater than 24h => defaults to 24h',
                    ],
                    'client_algo_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A unique id among Algo orders (length should be 32 characters)， If it is not sent, we will give default value',
                    ],
                    'reduce_only' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => '\'true\' or \'false\'. Default \'false\'; Cannot be sent in Hedge Mode; Cannot be sent when you open a position',
                    ],
                    'limit_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Limit price of the order; If it is not sent, will place order by market price by default',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_algo_futures_order' => [
                'class' => BinanceDeleteSapiV1AlgoFuturesOrder::class,
                'name' => 'Cancel Algo Order(TRADE)',
                'description' => 'Cancel Algo Order(TRADE)

Cancel an active order. - You need to enable Futures Trading Permission for the api key which requests this endpoint. - Base URL: https://api.binance.com Weight(IP): 1

Official Binance Spot endpoint: DELETE /sapi/v1/algo/futures/order.',
                'parameters' => [
                    'algo_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'Eg. 14511',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_algo_futures_openorders' => [
                'class' => BinanceGetSapiV1AlgoFuturesOpenorders::class,
                'name' => 'Query Current Algo Open Orders (USER_DATA)',
                'description' => 'Query Current Algo Open Orders (USER_DATA)

- You need to enable Futures Trading Permission for the api key which requests this endpoint. - Base URL: https://api.binance.com Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/futures/openOrders.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_algo_futures_historicalorders' => [
                'class' => BinanceGetSapiV1AlgoFuturesHistoricalorders::class,
                'name' => 'Query Historical Algo Orders (USER_DATA)',
                'description' => 'Query Historical Algo Orders (USER_DATA)

- You need to enable Futures Trading Permission for the api key which requests this endpoint. - Base URL: https://api.binance.com Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/futures/historicalOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'MIN 1, MAX 100; Default 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_algo_futures_suborders' => [
                'class' => BinanceGetSapiV1AlgoFuturesSuborders::class,
                'name' => 'Query Sub Orders (USER_DATA)',
                'description' => 'Query Sub Orders (USER_DATA)

- You need to enable Futures Trading Permission for the api key which requests this endpoint. - Base URL: https://api.binance.com Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/futures/subOrders.',
                'parameters' => [
                    'algo_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `algoId`.',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'MIN 1, MAX 100; Default 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_algo_spot_newordertwap' => [
                'class' => BinancePostSapiV1AlgoSpotNewordertwap::class,
                'name' => 'Time-Weighted Average Price (Twap) New Order',
                'description' => 'Time-Weighted Average Price (Twap) New Order

Place a new spot TWAP order with Algo service. Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/algo/spot/newOrderTwap.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'quantity' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `quantity`.',
                    ],
                    'duration' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `duration`.',
                    ],
                    'client_algo_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `clientAlgoId`.',
                    ],
                    'limit_price' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `limitPrice`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_delete_sapi_v1_algo_spot_order' => [
                'class' => BinanceDeleteSapiV1AlgoSpotOrder::class,
                'name' => 'Cancel Algo Order',
                'description' => 'Cancel Algo Order

Cancel an open TWAP order Weight(IP): 1

Official Binance Spot endpoint: DELETE /sapi/v1/algo/spot/order.',
                'parameters' => [
                    'algo_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `algoId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_algo_spot_openorders' => [
                'class' => BinanceGetSapiV1AlgoSpotOpenorders::class,
                'name' => 'Query Current Algo Open Orders',
                'description' => 'Query Current Algo Open Orders

Get all open SPOT TWAP orders Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/spot/openOrders.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_algo_spot_historicalorders' => [
                'class' => BinanceGetSapiV1AlgoSpotHistoricalorders::class,
                'name' => 'Query Historical Algo Orders',
                'description' => 'Query Historical Algo Orders

Get all historical SPOT TWAP orders Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/spot/historicalOrders.',
                'parameters' => [
                    'symbol' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Trading symbol, e.g. BNBUSDT',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'MIN 1, MAX 100; Default 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_algo_spot_suborders' => [
                'class' => BinanceGetSapiV1AlgoSpotSuborders::class,
                'name' => 'Query Sub Orders',
                'description' => 'Query Sub Orders

Get respective sub orders for a specified algoId Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/spot/subOrders.',
                'parameters' => [
                    'algo_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `algoId`.',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'MIN 1, MAX 100; Default 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_portfolio_account' => [
                'class' => BinanceGetSapiV1PortfolioAccount::class,
                'name' => 'Portfolio Margin Account (USER_DATA)',
                'description' => 'Portfolio Margin Account (USER_DATA)

Get the account info \'Weight(IP): 1\'

Official Binance Spot endpoint: GET /sapi/v1/portfolio/account.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_portfolio_collateralrate' => [
                'class' => BinanceGetSapiV1PortfolioCollateralrate::class,
                'name' => 'Portfolio Margin Collateral Rate (MARKET_DATA)',
                'description' => 'Portfolio Margin Collateral Rate (MARKET_DATA)

Portfolio Margin Collateral Rate. Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/portfolio/collateralRate.',
                'parameters' => [],
            ],
            'binance_get_sapi_v2_portfolio_collateralrate' => [
                'class' => BinanceGetSapiV2PortfolioCollateralrate::class,
                'name' => 'Portfolio Margin Pro Tiered Collateral Rate(USER_DATA)',
                'description' => 'Portfolio Margin Pro Tiered Collateral Rate(USER_DATA)

Portfolio Margin PRO Tiered Collateral Rate Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v2/portfolio/collateralRate.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_portfolio_pmloan' => [
                'class' => BinanceGetSapiV1PortfolioPmloan::class,
                'name' => 'Portfolio Margin Bankruptcy Loan Amount (USER_DATA)',
                'description' => 'Portfolio Margin Bankruptcy Loan Amount (USER_DATA)

Query Portfolio Margin Bankruptcy Loan Amount. Weight(UID): 500

Official Binance Spot endpoint: GET /sapi/v1/portfolio/pmLoan.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_portfolio_repay' => [
                'class' => BinancePostSapiV1PortfolioRepay::class,
                'name' => 'Portfolio Margin Bankruptcy Loan Repay (USER_DATA)',
                'description' => 'Portfolio Margin Bankruptcy Loan Repay (USER_DATA)

Repay Portfolio Margin Bankruptcy Loan. Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/portfolio/repay.',
                'parameters' => [
                    'from' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `from`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_portfolio_interest_history' => [
                'class' => BinanceGetSapiV1PortfolioInterestHistory::class,
                'name' => 'Query Classic Portfolio Margin Negative Balance Interest History (USER_DATA)',
                'description' => 'Query Classic Portfolio Margin Negative Balance Interest History (USER_DATA)

Query interest history of negative balance for portfolio margin. Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/portfolio/interest-history.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_portfolio_asset_index_price' => [
                'class' => BinanceGetSapiV1PortfolioAssetIndexPrice::class,
                'name' => 'Query Portfolio Margin Asset Index Price (MARKET_DATA)',
                'description' => 'Query Portfolio Margin Asset Index Price (MARKET_DATA)

Query Portfolio Margin Asset Index Price Weight(IP): - 1 if send asset - 50 if not send asset

Official Binance Spot endpoint: GET /sapi/v1/portfolio/asset-index-price.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                ],
            ],
            'binance_post_sapi_v1_portfolio_auto_collection' => [
                'class' => BinancePostSapiV1PortfolioAutoCollection::class,
                'name' => 'Fund Auto-collection (USER_DATA)',
                'description' => 'Fund Auto-collection (USER_DATA)

Transfers all assets from Futures Account to Margin account Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/auto-collection.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_portfolio_bnb_transfer' => [
                'class' => BinancePostSapiV1PortfolioBnbTransfer::class,
                'name' => 'BNB Transfer (USER_DATA)',
                'description' => 'BNB Transfer (USER_DATA)

BNB transfer can be between Margin Account and USDM Account Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/bnb-transfer.',
                'parameters' => [
                    'transfer_side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `transferSide`.',
                        'enum' => [
                            'TO_UM',
                            'FROM_UM',
                        ],
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_portfolio_repay_futures_switch' => [
                'class' => BinancePostSapiV1PortfolioRepayFuturesSwitch::class,
                'name' => 'Change Auto-repay-futures Status (USER_DATA)',
                'description' => 'Change Auto-repay-futures Status (USER_DATA)

Change Auto-repay-futures Status Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/repay-futures-switch.',
                'parameters' => [
                    'auto_repay' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'query parameter `autoRepay`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_portfolio_repay_futures_switch' => [
                'class' => BinanceGetSapiV1PortfolioRepayFuturesSwitch::class,
                'name' => 'Get Auto-repay-futures Status (USER_DATA)',
                'description' => 'Get Auto-repay-futures Status (USER_DATA)

Query Auto-repay-futures Status Weight(IP): 30

Official Binance Spot endpoint: GET /sapi/v1/portfolio/repay-futures-switch.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_portfolio_repay_futures_negative_balance' => [
                'class' => BinancePostSapiV1PortfolioRepayFuturesNegativeBalance::class,
                'name' => 'Repay futures Negative Balance (USER_DATA)',
                'description' => 'Repay futures Negative Balance (USER_DATA)

Repay futures Negative Balance Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/repay-futures-negative-balance.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_portfolio_margin_asset_leverage' => [
                'class' => BinanceGetSapiV1PortfolioMarginAssetLeverage::class,
                'name' => 'Get Portfolio Margin Asset Leverage (USER_DATA)',
                'description' => 'Get Portfolio Margin Asset Leverage (USER_DATA)

Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/portfolio/margin-asset-leverage.',
                'parameters' => [],
            ],
            'binance_post_sapi_v1_portfolio_asset_collection' => [
                'class' => BinancePostSapiV1PortfolioAssetCollection::class,
                'name' => 'Fund Collection by Asset (USER_DATA)',
                'description' => 'Fund Collection by Asset (USER_DATA)

Transfers specific asset from Futures Account to Margin account Weight(IP): 60

Official Binance Spot endpoint: POST /sapi/v1/portfolio/asset-collection.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `asset`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_blvt_tokeninfo' => [
                'class' => BinanceGetSapiV1BlvtTokeninfo::class,
                'name' => 'BLVT Info (MARKET_DATA)',
                'description' => 'BLVT Info (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/blvt/tokenInfo.',
                'parameters' => [
                    'token_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'BTCDOWN, BTCUP',
                    ],
                ],
            ],
            'binance_post_sapi_v1_blvt_subscribe' => [
                'class' => BinancePostSapiV1BlvtSubscribe::class,
                'name' => 'Subscribe BLVT (USER_DATA)',
                'description' => 'Subscribe BLVT (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/blvt/subscribe.',
                'parameters' => [
                    'token_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BTCDOWN, BTCUP',
                    ],
                    'cost' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Spot balance',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_blvt_subscribe_record' => [
                'class' => BinanceGetSapiV1BlvtSubscribeRecord::class,
                'name' => 'Query Subscription Record (USER_DATA)',
                'description' => 'Query Subscription Record (USER_DATA)

- Only the data of the latest 90 days is available Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/blvt/subscribe/record.',
                'parameters' => [
                    'token_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'BTCDOWN, BTCUP',
                    ],
                    'id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `id`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_blvt_redeem' => [
                'class' => BinancePostSapiV1BlvtRedeem::class,
                'name' => 'Redeem BLVT (USER_DATA)',
                'description' => 'Redeem BLVT (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/blvt/redeem.',
                'parameters' => [
                    'token_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'BTCDOWN, BTCUP',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_blvt_redeem_record' => [
                'class' => BinanceGetSapiV1BlvtRedeemRecord::class,
                'name' => 'Redemption Record (USER_DATA)',
                'description' => 'Redemption Record (USER_DATA)

- Only the data of the latest 90 days is available Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/blvt/redeem/record.',
                'parameters' => [
                    'token_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'BTCDOWN, BTCUP',
                    ],
                    'id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `id`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 1000, max 1000',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_blvt_userlimit' => [
                'class' => BinanceGetSapiV1BlvtUserlimit::class,
                'name' => 'BLVT User Limit Info (USER_DATA)',
                'description' => 'BLVT User Limit Info (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/blvt/userLimit.',
                'parameters' => [
                    'token_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'BTCDOWN, BTCUP',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_c2c_ordermatch_listuserorderhistory' => [
                'class' => BinanceGetSapiV1C2cOrdermatchListuserorderhistory::class,
                'name' => 'Get C2C Trade History (USER_DATA)',
                'description' => 'Get C2C Trade History (USER_DATA)

- If startTimestamp and endTimestamp are not sent, the recent 30-day data will be returned. - The max interval between startTimestamp and endTimestamp is 30 days. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/c2c/orderMatch/listUserOrderHistory.',
                'parameters' => [
                    'trade_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `tradeType`.',
                        'enum' => [
                            'BUY',
                            'SELL',
                        ],
                    ],
                    'start_timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'rows' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 100, max 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_vip_ongoing_orders' => [
                'class' => BinanceGetSapiV1LoanVipOngoingOrders::class,
                'name' => 'Get VIP Loan Ongoing Orders (USER_DATA)',
                'description' => 'Get VIP Loan Ongoing Orders (USER_DATA)

VIP loan is available for VIP users only. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/ongoing/orders.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'collateral_account_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `collateralAccountId`.',
                    ],
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 10; max 100.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_loan_vip_repay' => [
                'class' => BinancePostSapiV1LoanVipRepay::class,
                'name' => 'VIP Loan Repay (TRADE)',
                'description' => 'VIP Loan Repay (TRADE)

VIP loan is available for VIP users only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/vip/repay.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_vip_repay_history' => [
                'class' => BinanceGetSapiV1LoanVipRepayHistory::class,
                'name' => 'Get VIP Loan Repayment History (USER_DATA)',
                'description' => 'Get VIP Loan Repayment History (USER_DATA)

VIP loan is available for VIP users only. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/repay/history.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 10; max 100.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_vip_collateral_account' => [
                'class' => BinanceGetSapiV1LoanVipCollateralAccount::class,
                'name' => 'Check Locked Value of VIP Collateral Account (USER_DATA)',
                'description' => 'Check Locked Value of VIP Collateral Account (USER_DATA)

VIP loan is available for VIP users only. Weight(IP): 6000

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/collateral/account.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'collateral_account_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `collateralAccountId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_loan_vip_borrow' => [
                'class' => BinancePostSapiV1LoanVipBorrow::class,
                'name' => 'VIP Loan Borrow',
                'description' => 'VIP Loan Borrow

VIP loan is available for VIP users only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/vip/borrow.',
                'parameters' => [
                    'loan_account_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `loanAccountId`.',
                    ],
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'loan_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `loanAmount`.',
                    ],
                    'collateral_account_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `collateralAccountId`.',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `collateralCoin`.',
                    ],
                    'is_flexible_rate' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `isFlexibleRate`.',
                        'enum' => [
                            'TRUE',
                            'FALSE',
                        ],
                    ],
                    'loan_term' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `loanTerm`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_vip_loanable_data' => [
                'class' => BinanceGetSapiV1LoanVipLoanableData::class,
                'name' => 'Get Loanable Assets Data',
                'description' => 'Get Loanable Assets Data

Get interest rate and borrow limit of loanable assets. The borrow limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/loanable/data.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'vip_level' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Defaults to user\'s vip level',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_vip_collateral_data' => [
                'class' => BinanceGetSapiV1LoanVipCollateralData::class,
                'name' => 'Get Collateral Asset Data (USER_DATA)',
                'description' => 'Get Collateral Asset Data (USER_DATA)

Get collateral asset data. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/collateral/data.',
                'parameters' => [
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_vip_request_data' => [
                'class' => BinanceGetSapiV1LoanVipRequestData::class,
                'name' => 'Query Application Status (USER_DATA)',
                'description' => 'Query Application Status (USER_DATA)

Get Application Status Weight(UID): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/request/data.',
                'parameters' => [
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_vip_request_interestrate' => [
                'class' => BinanceGetSapiV1LoanVipRequestInterestrate::class,
                'name' => 'Get Borrow Interest Rate (USER_DATA)',
                'description' => 'Get Borrow Interest Rate (USER_DATA)

Get borrow interest rate. Weight(UID): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/request/interestRate.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Max 10 assets, Multiple split by ","',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_loan_vip_renew' => [
                'class' => BinancePostSapiV1LoanVipRenew::class,
                'name' => 'VIP Loan Renew',
                'description' => 'VIP Loan Renew

VIP loan is available for VIP users only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/vip/renew.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order id',
                    ],
                    'loan_term' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `loanTerm`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_income' => [
                'class' => BinanceGetSapiV1LoanIncome::class,
                'name' => 'Get Crypto Loans Income History (USER_DATA)',
                'description' => 'Get Crypto Loans Income History (USER_DATA)

- If startTime and endTime are not sent, the recent 7-day data will be returned. - The max interval between startTime and endTime is 30 days. Weight(UID): 6000

Official Binance Spot endpoint: GET /sapi/v1/loan/income.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'All types will be returned by default. * `borrowIn` * `collateralSpent` * `repayAmount` * `collateralReturn` - Collateral return after repayment * `addCollateral` * `removeCollateral` * `collateralReturnAfterLiquidation`',
                        'enum' => [
                            'borrowIn',
                            'collateralSpent',
                            'repayAmount',
                            'collateralReturn',
                            'addCollateral',
                            'removeCollateral',
                            'collateralReturnAfterLiquidation',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 20, max 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_loan_borrow' => [
                'class' => BinancePostSapiV1LoanBorrow::class,
                'name' => 'Crypto Loan Borrow (TRADE)',
                'description' => 'Crypto Loan Borrow (TRADE)

Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/borrow.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin loaned',
                    ],
                    'loan_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Loan amount',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin used as collateral',
                    ],
                    'collateral_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `collateralAmount`.',
                    ],
                    'loan_term' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '7/14/30/90/180 days',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_borrow_history' => [
                'class' => BinanceGetSapiV1LoanBorrowHistory::class,
                'name' => 'Get Crypto Loans Borrow History (USER_DATA)',
                'description' => 'Get Crypto Loans Borrow History (USER_DATA)

- If startTime and endTime are not sent, the recent 90-day data will be returned. - The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/borrow/history.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'orderId in POST /sapi/v1/loan/borrow',
                    ],
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 10, max 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_ongoing_orders' => [
                'class' => BinanceGetSapiV1LoanOngoingOrders::class,
                'name' => 'Get Loan Ongoing Orders (USER_DATA)',
                'description' => 'Get Loan Ongoing Orders (USER_DATA)

Weight(IP): 300

Official Binance Spot endpoint: GET /sapi/v1/loan/ongoing/orders.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'orderId in POST /sapi/v1/loan/borrow',
                    ],
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1; default:1, max:1000',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 10, max 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_loan_repay' => [
                'class' => BinancePostSapiV1LoanRepay::class,
                'name' => 'Crypto Loan Repay (TRADE)',
                'description' => 'Crypto Loan Repay (TRADE)

Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/repay.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'Order ID',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Repayment Amount',
                    ],
                    'type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default: 1. 1 for \'repay with borrowed coin\'; 2 for \'repay with collateral\'.',
                    ],
                    'collateral_return' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Default: TRUE. TRUE: Return extra collateral to spot account; FALSE: Keep extra collateral in the order.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_repay_history' => [
                'class' => BinanceGetSapiV1LoanRepayHistory::class,
                'name' => 'Get Loan Repayment History (USER_DATA)',
                'description' => 'Get Loan Repayment History (USER_DATA)

If startTime and endTime are not sent, the recent 90-day data will be returned. The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/repay/history.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order ID',
                    ],
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 10, max 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_loan_adjust_ltv' => [
                'class' => BinancePostSapiV1LoanAdjustLtv::class,
                'name' => 'Crypto Loan Adjust LTV (TRADE)',
                'description' => 'Crypto Loan Adjust LTV (TRADE)

Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/adjust/ltv.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'Order ID',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Amount',
                    ],
                    'direction' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => '\'ADDITIONAL\', \'REDUCED\'',
                        'enum' => [
                            'ADDITIONAL',
                            'REDUCED',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_ltv_adjustment_history' => [
                'class' => BinanceGetSapiV1LoanLtvAdjustmentHistory::class,
                'name' => 'Get Loan LTV Adjustment History (USER_DATA)',
                'description' => 'Get Loan LTV Adjustment History (USER_DATA)

If startTime and endTime are not sent, the recent 90-day data will be returned. The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/ltv/adjustment/history.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Order ID',
                    ],
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 10, max 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_loanable_data' => [
                'class' => BinanceGetSapiV1LoanLoanableData::class,
                'name' => 'Get Loanable Assets Data (USER_DATA)',
                'description' => 'Get Loanable Assets Data (USER_DATA)

Get interest rate and borrow limit of loanable assets. The borrow limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/loanable/data.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'vip_level' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Defaults to user\'s vip level',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_collateral_data' => [
                'class' => BinanceGetSapiV1LoanCollateralData::class,
                'name' => 'Get Collateral Assets Data (USER_DATA)',
                'description' => 'Get Collateral Assets Data (USER_DATA)

Get LTV information and collateral limit of collateral assets. The collateral limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/collateral/data.',
                'parameters' => [
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'vip_level' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Defaults to user\'s vip level',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_loan_repay_collateral_rate' => [
                'class' => BinanceGetSapiV1LoanRepayCollateralRate::class,
                'name' => 'Check Collateral Repay Rate (USER_DATA)',
                'description' => 'Check Collateral Repay Rate (USER_DATA)

Get the the rate of collateral coin / loan coin when using collateral repay, the rate will be valid within 8 second. Weight(IP): 6000

Official Binance Spot endpoint: GET /sapi/v1/loan/repay/collateral/rate.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Coin used as collateral',
                    ],
                    'repay_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'repay amount of loanCoin',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_loan_customize_margin_call' => [
                'class' => BinancePostSapiV1LoanCustomizeMarginCall::class,
                'name' => 'Crypto Loan Customize Margin Call (TRADE)',
                'description' => 'Crypto Loan Customize Margin Call (TRADE)

Customize margin call for ongoing orders only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/customize/margin_call.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Mandatory when collateralCoin is empty. Send either orderId or collateralCoin, if both parameters are sent, take orderId only.',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'margin_call' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `marginCall`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v2_loan_flexible_borrow' => [
                'class' => BinancePostSapiV2LoanFlexibleBorrow::class,
                'name' => 'Borrow - Flexible Loan Borrow (TRADE)',
                'description' => 'Borrow - Flexible Loan Borrow (TRADE)

- Only available for master account Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v2/loan/flexible/borrow.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'loan_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Loan amount',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'collateral_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `collateralAmount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_loan_flexible_ongoing_orders' => [
                'class' => BinanceGetSapiV2LoanFlexibleOngoingOrders::class,
                'name' => 'Borrow - Get Flexible Loan Ongoing Orders (USER_DATA)',
                'description' => 'Borrow - Get Flexible Loan Ongoing Orders (USER_DATA)

Weight(IP): 300

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/ongoing/orders.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_loan_flexible_borrow_history' => [
                'class' => BinanceGetSapiV2LoanFlexibleBorrowHistory::class,
                'name' => 'Borrow - Get Flexible Loan Borrow History (USER_DATA)',
                'description' => 'Borrow - Get Flexible Loan Borrow History (USER_DATA)

- If startTime and endTime are not sent, the recent 90-day data will be returned. - The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/borrow/history.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v2_loan_flexible_repay' => [
                'class' => BinancePostSapiV2LoanFlexibleRepay::class,
                'name' => 'Repay - Flexible Loan Repay (TRADE)',
                'description' => 'Repay - Flexible Loan Repay (TRADE)

- repayAmount is mandatory even fullRepayment = FALSE Weight(IP): 6000

Official Binance Spot endpoint: POST /sapi/v2/loan/flexible/repay.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'repay_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'repay amount of loanCoin',
                    ],
                    'collateral_return' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Default: TRUE. TRUE: Return extra collateral to earn account; FALSE: Keep extra collateral in the order, and lower LTV.',
                    ],
                    'full_repayment' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Default: FALSE. TRUE: Full repayment; FALSE: Partial repayment, based on loanAmount',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_loan_flexible_repay_history' => [
                'class' => BinanceGetSapiV2LoanFlexibleRepayHistory::class,
                'name' => 'Repay - Get Flexible Loan Repayment History (USER_DATA)',
                'description' => 'Repay - Get Flexible Loan Repayment History (USER_DATA)

- If startTime and endTime are not sent, the recent 90-day data will be returned. - The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/repay/history.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v2_loan_flexible_adjust_ltv' => [
                'class' => BinancePostSapiV2LoanFlexibleAdjustLtv::class,
                'name' => 'Adjust LTV - Flexible Loan Adjust LTV (TRADE)',
                'description' => 'Adjust LTV - Flexible Loan Adjust LTV (TRADE)

- API Key needs Spot & Margin Trading permission for this endpoint Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v2/loan/flexible/adjust/ltv.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'adjustment_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `adjustmentAmount`.',
                    ],
                    'direction' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `direction`.',
                        'enum' => [
                            'ADDITIONAL',
                            'REDUCED',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_loan_flexible_ltv_adjustment_history' => [
                'class' => BinanceGetSapiV2LoanFlexibleLtvAdjustmentHistory::class,
                'name' => 'Adjust LTV - Get Flexible Loan LTV Adjustment History (USER_DATA)',
                'description' => 'Adjust LTV - Get Flexible Loan LTV Adjustment History (USER_DATA)

- If startTime and endTime are not sent, the recent 90-day data will be returned. - The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/ltv/adjustment/history.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 500; max 1000.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_loan_flexible_loanable_data' => [
                'class' => BinanceGetSapiV2LoanFlexibleLoanableData::class,
                'name' => 'Get Flexible Loan Assets Data (USER_DATA)',
                'description' => 'Get Flexible Loan Assets Data (USER_DATA)

Get interest rate and borrow limit of flexible loanable assets. The borrow limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/loanable/data.',
                'parameters' => [
                    'loan_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin loaned',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_loan_flexible_collateral_data' => [
                'class' => BinanceGetSapiV2LoanFlexibleCollateralData::class,
                'name' => 'Get Flexible Loan Collateral Assets Data (USER_DATA)',
                'description' => 'Get Flexible Loan Collateral Assets Data (USER_DATA)

Get LTV information and collateral limit of flexible loan\'s collateral assets. The collateral limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/collateral/data.',
                'parameters' => [
                    'collateral_coin' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Coin used as collateral',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_pay_transactions' => [
                'class' => BinanceGetSapiV1PayTransactions::class,
                'name' => 'Get Pay Trade History (USER_DATA)',
                'description' => 'Get Pay Trade History (USER_DATA)

- If startTime and endTime are not sent, the recent 90 days\' data will be returned. - The max interval between startTime and endTime is 90 days. - Support for querying orders within the last 18 months. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/pay/transactions.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 100, max 100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_convert_exchangeinfo' => [
                'class' => BinanceGetSapiV1ConvertExchangeinfo::class,
                'name' => 'List All Convert Pairs',
                'description' => 'List All Convert Pairs

Query for all convertible token pairs and the tokens’ respective upper/lower limits Weight(IP): 3000

Official Binance Spot endpoint: GET /sapi/v1/convert/exchangeInfo.',
                'parameters' => [
                    'from_asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User spends coin',
                    ],
                    'to_asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'User receives coin',
                    ],
                ],
            ],
            'binance_get_sapi_v1_convert_assetinfo' => [
                'class' => BinanceGetSapiV1ConvertAssetinfo::class,
                'name' => 'Query order quantity precision per asset (USER_DATA)',
                'description' => 'Query order quantity precision per asset (USER_DATA)

Query for supported asset precision information Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/convert/assetInfo.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_convert_getquote' => [
                'class' => BinancePostSapiV1ConvertGetquote::class,
                'name' => 'Send quote request (USER_DATA)',
                'description' => 'Send quote request (USER_DATA)

Request a quote for the requested token pairs Weight(UID): 200

Official Binance Spot endpoint: POST /sapi/v1/convert/getQuote.',
                'parameters' => [
                    'from_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `fromAsset`.',
                    ],
                    'to_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `toAsset`.',
                    ],
                    'from_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'When specified, it is the amount you will be debited after the conversion',
                    ],
                    'to_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'When specified, it is the amount you will be debited after the conversion',
                    ],
                    'valid_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '10s, 30s, 1m, 2m, default 10s',
                    ],
                    'wallet_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT or FUNDING. Default is SPOT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_convert_acceptquote' => [
                'class' => BinancePostSapiV1ConvertAcceptquote::class,
                'name' => 'Accept Quote (TRADE)',
                'description' => 'Accept Quote (TRADE)

Accept the offered quote by quote ID. Weight(UID): 500

Official Binance Spot endpoint: POST /sapi/v1/convert/acceptQuote.',
                'parameters' => [
                    'quote_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `quoteId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_convert_orderstatus' => [
                'class' => BinanceGetSapiV1ConvertOrderstatus::class,
                'name' => 'Order status (USER_DATA)',
                'description' => 'Order status (USER_DATA)

Query order status by order ID. Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/convert/orderStatus.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `orderId`.',
                    ],
                    'quote_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `quoteId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_convert_limit_placeorder' => [
                'class' => BinancePostSapiV1ConvertLimitPlaceorder::class,
                'name' => 'Place limit order (USER_DATA)',
                'description' => 'Place limit order (USER_DATA)

Enable users to place a limit order - baseAsset or quoteAsset can be determined via exchangeInfo endpoint. - Limit price is defined from baseAsset to quoteAsset. - Either baseAmount or quoteAmount is used. Weight(UID): 500

Official Binance Spot endpoint: POST /sapi/v1/convert/limit/placeOrder.',
                'parameters' => [
                    'base_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `baseAsset`.',
                    ],
                    'quote_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `quoteAsset`.',
                    ],
                    'limit_price' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Symbol limit price (from baseAsset to quoteAsset)',
                    ],
                    'base_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Base asset amount. (One of baseAmount or quoteAmount is required)',
                    ],
                    'quote_amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Quote asset amount. (One of baseAmount or quoteAmount is required)',
                    ],
                    'side' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `side`.',
                        'enum' => [
                            'SELL',
                            'BUY',
                        ],
                    ],
                    'wallet_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT or FUNDING or SPOT_FUNDING. It is to use which type of assets. Default is SPOT.',
                        'enum' => [
                            'SPOT',
                            'FUNDING',
                            'SPOT_FUNDING',
                        ],
                    ],
                    'expired_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '1_D, 3_D, 7_D, 30_D (D means day)',
                        'enum' => [
                            '1_D',
                            '3_D',
                            '7_D',
                            '30_D',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_convert_limit_cancelorder' => [
                'class' => BinancePostSapiV1ConvertLimitCancelorder::class,
                'name' => 'Cancel limit order (USER_DATA)',
                'description' => 'Cancel limit order (USER_DATA)

Enable users to cancel a limit order Weight(UID): 200

Official Binance Spot endpoint: POST /sapi/v1/convert/limit/cancelOrder.',
                'parameters' => [
                    'order_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `orderId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_convert_limit_queryopenorders' => [
                'class' => BinanceGetSapiV1ConvertLimitQueryopenorders::class,
                'name' => 'Query limit open orders (USER_DATA)',
                'description' => 'Query limit open orders (USER_DATA)

Enable users to query for all existing limit orders Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/convert/limit/queryOpenOrders.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_convert_tradeflow' => [
                'class' => BinanceGetSapiV1ConvertTradeflow::class,
                'name' => 'Get Convert Trade History (USER_DATA)',
                'description' => 'Get Convert Trade History (USER_DATA)

- The max interval between startTime and endTime is 30 days. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/convert/tradeFlow.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 100, max 1000',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_rebate_taxquery' => [
                'class' => BinanceGetSapiV1RebateTaxquery::class,
                'name' => 'Get Spot Rebate History Records (USER_DATA)',
                'description' => 'Get Spot Rebate History Records (USER_DATA)

- The max interval between startTime and endTime is 90 days. - If startTime and endTime are not sent, the recent 7 days\' data will be returned. - The earliest startTime is supported on June 10, 2020 Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/rebate/taxQuery.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'default 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_nft_history_transactions' => [
                'class' => BinanceGetSapiV1NftHistoryTransactions::class,
                'name' => 'Get NFT Transaction History (USER_DATA)',
                'description' => 'Get NFT Transaction History (USER_DATA)

- The max interval between startTime and endTime is 90 days. - If startTime and endTime are not sent, the recent 7 days\' data will be returned. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/nft/history/transactions.',
                'parameters' => [
                    'order_type' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => '0: purchase order, 1: sell order, 2: royalty income, 3: primary market order, 4: mint fee',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 50, Max 50',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_nft_history_deposit' => [
                'class' => BinanceGetSapiV1NftHistoryDeposit::class,
                'name' => 'Get NFT Deposit History(USER_DATA)',
                'description' => 'Get NFT Deposit History(USER_DATA)

- The max interval between startTime and endTime is 90 days. - If startTime and endTime are not sent, the recent 7 days\' data will be returned. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/nft/history/deposit.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 50, Max 50',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_nft_history_withdraw' => [
                'class' => BinanceGetSapiV1NftHistoryWithdraw::class,
                'name' => 'Get NFT Withdraw History (USER_DATA)',
                'description' => 'Get NFT Withdraw History (USER_DATA)

- The max interval between startTime and endTime is 90 days. - If startTime and endTime are not sent, the recent 7 days\' data will be returned. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/nft/history/withdraw.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 50, Max 50',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_nft_user_getasset' => [
                'class' => BinanceGetSapiV1NftUserGetasset::class,
                'name' => 'Get NFT Asset (USER_DATA)',
                'description' => 'Get NFT Asset (USER_DATA)

Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/nft/user/getAsset.',
                'parameters' => [
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 50, Max 50',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_giftcard_createcode' => [
                'class' => BinancePostSapiV1GiftcardCreatecode::class,
                'name' => 'Create a Binance Code (USER_DATA)',
                'description' => 'Create a Binance Code (USER_DATA)

This API is for creating a Binance Code. To get started with, please make sure: - You have a Binance account - You have passed kyc - You have a sufficient balance in your Binance funding wallet - You need Enable Withdrawals for the API Key which requests this endpoint. Daily creation volume: 2 BTC / 24H Daily creation times: 200 Codes / 24H Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/giftcard/createCode.',
                'parameters' => [
                    'token' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The coin type contained in the Binance Code',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The amount of the coin',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_giftcard_redeemcode' => [
                'class' => BinancePostSapiV1GiftcardRedeemcode::class,
                'name' => 'Redeem a Binance Code (USER_DATA)',
                'description' => 'Redeem a Binance Code (USER_DATA)

This API is for redeeming the Binance Code. Once redeemed, the coins will be deposited in your funding wallet. Please note that if you enter the wrong code 5 times within 24 hours, you will no longer be able to redeem any Binance Code that day. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/giftcard/redeemCode.',
                'parameters' => [
                    'code' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Binance Code',
                    ],
                    'external_uid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Each external unique ID represents a unique user on the partner platform. The function helps you to identify the redemption behavior of different users, such as redemption frequency and amount. It also helps risk and limit control of a single account, such as daily limit on redemption volume, frequency, and incorrect number of entries. This will also prevent a single user account reach the partner\'s daily redemption limits. We strongly recommend you to use this feature and transfer us the User ID of your users if you have different users redeeming Binance codes on your platform. To protect user data privacy, you may choose to transfer the user id in any desired format (max. 400 characters).',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_giftcard_verify' => [
                'class' => BinanceGetSapiV1GiftcardVerify::class,
                'name' => 'Verify a Binance Code (USER_DATA)',
                'description' => 'Verify a Binance Code (USER_DATA)

This API is for verifying whether the Binance Code is valid or not by entering Binance Code or reference number. Please note that if you enter the wrong binance code 5 times within an hour, you will no longer be able to verify any binance code for that hour. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/giftcard/verify.',
                'parameters' => [
                    'reference_no' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'reference number',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_giftcard_cryptography_rsa_public_key' => [
                'class' => BinanceGetSapiV1GiftcardCryptographyRsaPublicKey::class,
                'name' => 'Fetch RSA Public Key (USER_DATA)',
                'description' => 'Fetch RSA Public Key (USER_DATA)

This API is for fetching the RSA Public Key. This RSA Public key will be used to encrypt the card code. Please note that the RSA Public key fetched is valid only for the current day. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/giftcard/cryptography/rsa-public-key.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_giftcard_buycode' => [
                'class' => BinancePostSapiV1GiftcardBuycode::class,
                'name' => 'Buy a Binance Code (TRADE)',
                'description' => 'Buy a Binance Code (TRADE)

This API is for buying a fixed-value Binance Code, which means your Binance Code will be redeemable to a token that is different to the token that you are paying in. If the token you’re paying and the redeemable token are the same, please use the Create Binance Code endpoint. You can use supported crypto currency or fiat token as baseToken to buy Binance Code that is redeemable to your chosen faceToken. Once successfully purchased, the amount of baseToken would be deducted from your funding wallet. To get started with, please make sure: - You have a Binance account - You have passed kyc - You have a sufficient balance in your Binance funding wallet - You need Enable Withdrawals for the API Key which requests this endpoint. Daily creation volume: 2 BTC / 24H Daily creation times: 200 Codes / 24H Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/giftcard/buyCode.',
                'parameters' => [
                    'base_token' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The token you want to pay, example BUSD',
                    ],
                    'face_token' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The token you want to buy, example BNB. If faceToken = baseToken, it\'s the same as createCode endpoint.',
                    ],
                    'base_token_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The base token asset quantity, example 1.002',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_giftcard_buycode_token_limit' => [
                'class' => BinanceGetSapiV1GiftcardBuycodeTokenLimit::class,
                'name' => 'Fetch Token Limit (USER_DATA)',
                'description' => 'Fetch Token Limit (USER_DATA)

This API is to help you verify which tokens are available for you to purchase fixed-value gift cards as mentioned in section 2 and it\'s limitation. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/giftcard/buyCode/token-limit.',
                'parameters' => [
                    'base_token' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The token you want to pay, example BUSD',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_target_asset_list' => [
                'class' => BinanceGetSapiV1LendingAutoInvestTargetAssetList::class,
                'name' => 'Get target asset list (USER_DATA)',
                'description' => 'Get target asset list (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/target-asset/list.',
                'parameters' => [
                    'target_asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `targetAsset`.',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_target_asset_roi_list' => [
                'class' => BinanceGetSapiV1LendingAutoInvestTargetAssetRoiList::class,
                'name' => 'Get target asset ROI data (USER_DATA)',
                'description' => 'Get target asset ROI data (USER_DATA)

ROI return list for target asset Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/target-asset/roi/list.',
                'parameters' => [
                    'target_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `targetAsset`.',
                    ],
                    'his_roi_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `hisRoiType`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_all_asset' => [
                'class' => BinanceGetSapiV1LendingAutoInvestAllAsset::class,
                'name' => 'Query all source asset and target asset (USER_DATA)',
                'description' => 'Query all source asset and target asset (USER_DATA)

Query all source assets and target assets Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/all/asset.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_source_asset_list' => [
                'class' => BinanceGetSapiV1LendingAutoInvestSourceAssetList::class,
                'name' => 'Query source asset list (USER_DATA)',
                'description' => 'Query source asset list (USER_DATA)

Query Source Asset to be used for investment Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/source-asset/list.',
                'parameters' => [
                    'target_asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `targetAsset`.',
                    ],
                    'index_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `indexId`.',
                    ],
                    'usage_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `usageType`.',
                    ],
                    'flexible_allowed_to_use' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `flexibleAllowedToUse`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_lending_auto_invest_plan_add' => [
                'class' => BinancePostSapiV1LendingAutoInvestPlanAdd::class,
                'name' => 'Investment plan creation (USER_DATA)',
                'description' => 'Investment plan creation (USER_DATA)

Post an investment plan creation Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/plan/add.',
                'parameters' => [
                    'source_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `sourceType`.',
                        'enum' => [
                            'MAIN_SITE',
                            'TR',
                        ],
                    ],
                    'request_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `requestId`.',
                    ],
                    'plan_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `planType`.',
                        'enum' => [
                            'SINGLE',
                            'PORTFOLIO',
                            'INDEX',
                        ],
                    ],
                    'index_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `IndexId`.',
                    ],
                    'subscription_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `subscriptionAmount`.',
                    ],
                    'subscription_cycle' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `subscriptionCycle`.',
                        'enum' => [
                            'H1',
                            'H4',
                            'H8',
                            'H12',
                            'WEEKLY',
                            'DAILY',
                            'MONTHLY',
                            'BI_WEEKLY',
                        ],
                    ],
                    'subscription_start_day' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `subscriptionStartDay`.',
                    ],
                    'subscription_start_weekday' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `subscriptionStartWeekday`.',
                        'enum' => [
                            'MON',
                            'TUE',
                            'WED',
                            'THU',
                            'FRI',
                            'SAT',
                            'SUN',
                        ],
                    ],
                    'subscription_start_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `subscriptionStartTime`.',
                    ],
                    'source_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `sourceAsset`.',
                    ],
                    'flexible_allowed_to_use' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `flexibleAllowedToUse`.',
                    ],
                    'details' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'query parameter `details`.',
                        'items' => [
                            'type' => 'object',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_lending_auto_invest_plan_edit' => [
                'class' => BinancePostSapiV1LendingAutoInvestPlanEdit::class,
                'name' => 'Investment plan adjustment',
                'description' => 'Investment plan adjustment

Query Source Asset to be used for investment Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/plan/edit.',
                'parameters' => [
                    'plan_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `planId`.',
                    ],
                    'subscription_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `subscriptionAmount`.',
                    ],
                    'subscription_cycle' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `subscriptionCycle`.',
                        'enum' => [
                            'H1',
                            'H4',
                            'H8',
                            'H12',
                            'WEEKLY',
                            'DAILY',
                            'MONTHLY',
                            'BI_WEEKLY',
                        ],
                    ],
                    'subscription_start_day' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `subscriptionStartDay`.',
                    ],
                    'subscription_start_weekday' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `subscriptionStartWeekday`.',
                        'enum' => [
                            'MON',
                            'TUE',
                            'WED',
                            'THU',
                            'FRI',
                            'SAT',
                            'SUN',
                        ],
                    ],
                    'subscription_start_time' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `subscriptionStartTime`.',
                    ],
                    'source_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `sourceAsset`.',
                    ],
                    'flexible_allowed_to_use' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `flexibleAllowedToUse`.',
                    ],
                    'details' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'query parameter `details`.',
                        'items' => [
                            'type' => 'object',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_lending_auto_invest_plan_edit_status' => [
                'class' => BinancePostSapiV1LendingAutoInvestPlanEditStatus::class,
                'name' => 'Change Plan Status',
                'description' => 'Change Plan Status

Change Plan Status Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/plan/edit-status.',
                'parameters' => [
                    'plan_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `planId`.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `status`.',
                        'enum' => [
                            'ONGOING',
                            'PAUSED',
                            'REMOVED',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_plan_list' => [
                'class' => BinanceGetSapiV1LendingAutoInvestPlanList::class,
                'name' => 'Get list of plans',
                'description' => 'Get list of plans

Query plan lists Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/plan/list.',
                'parameters' => [
                    'plan_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `planType`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_plan_id' => [
                'class' => BinanceGetSapiV1LendingAutoInvestPlanId::class,
                'name' => 'Query holding details of the plan',
                'description' => 'Query holding details of the plan

Query holding details of the plan Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/plan/id.',
                'parameters' => [
                    'plan_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `planId`.',
                    ],
                    'request_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `requestId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_history_list' => [
                'class' => BinanceGetSapiV1LendingAutoInvestHistoryList::class,
                'name' => 'Query subscription transaction history',
                'description' => 'Query subscription transaction history

Query subscription transaction history of a plan Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/history/list.',
                'parameters' => [
                    'plan_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `planId`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'target_asset' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'query parameter `targetAsset`.',
                    ],
                    'plan_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `planType`.',
                        'enum' => [
                            'SINGLE',
                            'PORTFOLIO',
                            'INDEX',
                            'ALL',
                        ],
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_index_info' => [
                'class' => BinanceGetSapiV1LendingAutoInvestIndexInfo::class,
                'name' => 'Query Index Details(USER_DATA)',
                'description' => 'Query Index Details(USER_DATA)

Query index details Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/index/info.',
                'parameters' => [
                    'index_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `indexId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_index_user_summary' => [
                'class' => BinanceGetSapiV1LendingAutoInvestIndexUserSummary::class,
                'name' => 'Query Index Linked Plan Position Details(USER_DATA)',
                'description' => 'Query Index Linked Plan Position Details(USER_DATA)

Details on users Index-Linked plan position details Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/index/user-summary.',
                'parameters' => [
                    'index_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `indexId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_lending_auto_invest_one_off' => [
                'class' => BinancePostSapiV1LendingAutoInvestOneOff::class,
                'name' => 'One Time Transaction(TRADE)',
                'description' => 'One Time Transaction(TRADE)

One time transaction Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/one-off.',
                'parameters' => [
                    'source_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `sourceType`.',
                    ],
                    'request_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `requestId`.',
                    ],
                    'subscription_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `subscriptionAmount`.',
                    ],
                    'source_asset' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `sourceAsset`.',
                    ],
                    'flexible_allowed_to_use' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `flexibleAllowedToUse`.',
                    ],
                    'plan_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `planId`.',
                    ],
                    'index_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `indexId`.',
                    ],
                    'details' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'query parameter `details`.',
                        'items' => [
                            'type' => 'object',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_one_off_status' => [
                'class' => BinanceGetSapiV1LendingAutoInvestOneOffStatus::class,
                'name' => 'Query One-Time Transaction Status (USER_DATA)',
                'description' => 'Query One-Time Transaction Status (USER_DATA)

Transaction status for one-time transaction Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/one-off/status.',
                'parameters' => [
                    'transaction_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `transactionId`.',
                    ],
                    'request_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `requestId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_lending_auto_invest_redeem' => [
                'class' => BinancePostSapiV1LendingAutoInvestRedeem::class,
                'name' => 'Index Linked Plan Redemption (TRADE)',
                'description' => 'Index Linked Plan Redemption (TRADE)

To redeem index-Linked plan holdings Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/redeem.',
                'parameters' => [
                    'index_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'PORTFOLIO plan\'s Id',
                    ],
                    'request_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'sourceType + unique, transactionId and requestId cannot be empty at the same time',
                    ],
                    'redemption_percentage' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'user redeem percentage,10/20/100.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_redeem_history' => [
                'class' => BinanceGetSapiV1LendingAutoInvestRedeemHistory::class,
                'name' => 'Index Linked Plan Redemption History (USER_DATA)',
                'description' => 'Index Linked Plan Redemption History (USER_DATA)

Get the history of Index Linked Plan Redemption transactions Max 30 day difference between startTime and endTime If no startTime and endTime, default to show past 30 day records Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/redeem/history.',
                'parameters' => [
                    'request_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'query parameter `requestId`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_lending_auto_invest_rebalance_history' => [
                'class' => BinanceGetSapiV1LendingAutoInvestRebalanceHistory::class,
                'name' => 'Index Linked Plan Rebalance Details (USER_DATA)',
                'description' => 'Index Linked Plan Rebalance Details (USER_DATA)

Get the history of Index Linked Plan Redemption transactions Max 30 day difference between startTime and endTime If no startTime and endTime, default to show past 30 day records Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/rebalance/history.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v2_eth_staking_eth_stake' => [
                'class' => BinancePostSapiV2EthStakingEthStake::class,
                'name' => 'Subscribe ETH Staking V2(TRADE)',
                'description' => 'Subscribe ETH Staking V2(TRADE)

Stake ETH to get WBETH - You need to open Enable Spot & Margin Trading permission for the API Key which requests this endpoint. Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v2/eth-staking/eth/stake.',
                'parameters' => [
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Amount in ETH, limit 4 decimals',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_eth_staking_eth_redeem' => [
                'class' => BinancePostSapiV1EthStakingEthRedeem::class,
                'name' => 'Redeem ETH (TRADE)',
                'description' => 'Redeem ETH (TRADE)

Redeem WBETH or BETH and get ETH - You need to open Enable Spot & Margin Trading permission for the API Key which requests this endpoint. Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v1/eth-staking/eth/redeem.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'WBETH or BETH, default to BETH',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Amount in BETH, limit 8 decimals',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_eth_history_stakinghistory' => [
                'class' => BinanceGetSapiV1EthStakingEthHistoryStakinghistory::class,
                'name' => 'Get ETH staking history (USER_DATA)',
                'description' => 'Get ETH staking history (USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/eth/history/stakingHistory.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_eth_history_redemptionhistory' => [
                'class' => BinanceGetSapiV1EthStakingEthHistoryRedemptionhistory::class,
                'name' => 'Get ETH redemption history (USER_DATA)',
                'description' => 'Get ETH redemption history (USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/eth/history/redemptionHistory.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_eth_history_rewardshistory' => [
                'class' => BinanceGetSapiV1EthStakingEthHistoryRewardshistory::class,
                'name' => 'Get BETH rewards distribution history(USER_DATA)',
                'description' => 'Get BETH rewards distribution history(USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/eth/history/rewardsHistory.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_eth_quota' => [
                'class' => BinanceGetSapiV1EthStakingEthQuota::class,
                'name' => 'Get current ETH staking quota (USER_DATA)',
                'description' => 'Get current ETH staking quota (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/eth/quota.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_eth_history_ratehistory' => [
                'class' => BinanceGetSapiV1EthStakingEthHistoryRatehistory::class,
                'name' => 'Get WBETH Rate History (USER_DATA)',
                'description' => 'Get WBETH Rate History (USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/eth/history/rateHistory.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v2_eth_staking_account' => [
                'class' => BinanceGetSapiV2EthStakingAccount::class,
                'name' => 'ETH Staking account V2(USER_DATA)',
                'description' => 'ETH Staking account V2(USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v2/eth-staking/account.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_eth_staking_wbeth_wrap' => [
                'class' => BinancePostSapiV1EthStakingWbethWrap::class,
                'name' => 'Wrap BETH(TRADE)',
                'description' => 'Wrap BETH(TRADE)

- You need to open Enable Spot & Margin Trading permission for the API Key which requests this endpoint. Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v1/eth-staking/wbeth/wrap.',
                'parameters' => [
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Amount in BETH, limit 4 decimals',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_wbeth_history_wraphistory' => [
                'class' => BinanceGetSapiV1EthStakingWbethHistoryWraphistory::class,
                'name' => 'Get WBETH wrap history (USER_DATA)',
                'description' => 'Get WBETH wrap history (USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/wbeth/history/wrapHistory.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_wbeth_history_unwraphistory' => [
                'class' => BinanceGetSapiV1EthStakingWbethHistoryUnwraphistory::class,
                'name' => 'Get WBETH unwrap history (USER_DATA)',
                'description' => 'Get WBETH unwrap history (USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/wbeth/history/unwrapHistory.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_eth_staking_eth_history_wbethrewardshistory' => [
                'class' => BinanceGetSapiV1EthStakingEthHistoryWbethrewardshistory::class,
                'name' => 'Get WBETH rewards history(USER_DATA)',
                'description' => 'Get WBETH rewards history(USER_DATA)

- The time between startTime and endTime cannot be longer than 3 months. - If startTime and endTime are both not sent, then the last 30 days\' data will be returned. - If startTime is sent but endTime is not sent, the next 30 days\' data beginning from startTime will be returned. - If endTime is sent but startTime is not sent, the 30 days\' data before endTime will be returned. Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/eth-staking/eth/history/wbethRewardsHistory.',
                'parameters' => [
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_copytrading_futures_userstatus' => [
                'class' => BinanceGetSapiV1CopytradingFuturesUserstatus::class,
                'name' => 'Get Futures Lead Trader Status(TRADE)',
                'description' => 'Get Futures Lead Trader Status(TRADE)

Get Futures Lead Trader Status Weight(UID): 20

Official Binance Spot endpoint: GET /sapi/v1/copyTrading/futures/userStatus.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_copytrading_futures_leadsymbol' => [
                'class' => BinanceGetSapiV1CopytradingFuturesLeadsymbol::class,
                'name' => 'Get Futures Lead Trading Symbol Whitelist(USER_DATA)',
                'description' => 'Get Futures Lead Trading Symbol Whitelist(USER_DATA)

Get Futures Lead Trading Symbol Whitelist Weight(IP): 20

Official Binance Spot endpoint: GET /sapi/v1/copyTrading/futures/leadSymbol.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_list' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexibleList::class,
                'name' => 'Get Simple Earn Flexible Product List (USER_DATA)',
                'description' => 'Get Simple Earn Flexible Product List (USER_DATA)

Get available Simple Earn flexible product list Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/list.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_list' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedList::class,
                'name' => 'Get Simple Earn Locked Product List (USER_DATA)',
                'description' => 'Get Simple Earn Locked Product List (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/list.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_simple_earn_flexible_subscribe' => [
                'class' => BinancePostSapiV1SimpleEarnFlexibleSubscribe::class,
                'name' => 'Subscribe Flexible Product (TRADE)',
                'description' => 'Subscribe Flexible Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/flexible/subscribe.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `productId`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'auto_subscribe' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'true or false, default true.',
                    ],
                    'source_account' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT,FUND,ALL, default SPOT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_simple_earn_locked_subscribe' => [
                'class' => BinancePostSapiV1SimpleEarnLockedSubscribe::class,
                'name' => 'Subscribe Locked Product (TRADE)',
                'description' => 'Subscribe Locked Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/locked/subscribe.',
                'parameters' => [
                    'project_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `projectId`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'auto_subscribe' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'true or false, default true.',
                    ],
                    'source_account' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT,FUND,ALL, default SPOT',
                    ],
                    'redeem_to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT,FLEXIBLE, default FLEXIBLE',
                        'enum' => [
                            'SPOT',
                            'FLEXIBLE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_simple_earn_flexible_redeem' => [
                'class' => BinancePostSapiV1SimpleEarnFlexibleRedeem::class,
                'name' => 'Redeem Flexible Product (TRADE)',
                'description' => 'Redeem Flexible Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/flexible/redeem.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `productId`.',
                    ],
                    'redeem_all' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'true or false, default to false',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'if redeemAll is false, amount is mandatory',
                    ],
                    'dest_account' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT,FUND,ALL, default SPOT',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_simple_earn_locked_redeem' => [
                'class' => BinancePostSapiV1SimpleEarnLockedRedeem::class,
                'name' => 'Redeem Locked Product (TRADE)',
                'description' => 'Redeem Locked Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/locked/redeem.',
                'parameters' => [
                    'position_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => '1234',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_position' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexiblePosition::class,
                'name' => 'Get Flexible Product Position (USER_DATA)',
                'description' => 'Get Flexible Product Position (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/position.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'product_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `productId`.',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_position' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedPosition::class,
                'name' => 'Get Locked Product Position (USER_DATA)',
                'description' => 'Get Locked Product Position (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/position.',
                'parameters' => [
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'position_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `positionId`.',
                    ],
                    'project_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `projectId`.',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_account' => [
                'class' => BinanceGetSapiV1SimpleEarnAccount::class,
                'name' => 'Simple Account (USER_DATA)',
                'description' => 'Simple Account (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/account.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_history_subscriptionrecord' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexibleHistorySubscriptionrecord::class,
                'name' => 'Get Flexible Subscription Record (USER_DATA)',
                'description' => 'Get Flexible Subscription Record (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/history/subscriptionRecord.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `productId`.',
                    ],
                    'purchase_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `purchaseId`.',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_history_subscriptionrecord' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedHistorySubscriptionrecord::class,
                'name' => 'Get Locked Subscription Record (USER_DATA)',
                'description' => 'Get Locked Subscription Record (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/history/subscriptionRecord.',
                'parameters' => [
                    'purchase_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `purchaseId`.',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_history_redemptionrecord' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexibleHistoryRedemptionrecord::class,
                'name' => 'Get Flexible Redemption Record (USER_DATA)',
                'description' => 'Get Flexible Redemption Record (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/history/redemptionRecord.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `productId`.',
                    ],
                    'redeem_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `redeemId`.',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_history_redemptionrecord' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedHistoryRedemptionrecord::class,
                'name' => 'Get Locked Redemption Record (USER_DATA)',
                'description' => 'Get Locked Redemption Record (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/history/redemptionRecord.',
                'parameters' => [
                    'position_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `positionId`.',
                    ],
                    'redeem_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `redeemId`.',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_history_rewardsrecord' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexibleHistoryRewardsrecord::class,
                'name' => 'Get Flexible Rewards History (USER_DATA)',
                'description' => 'Get Flexible Rewards History (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/history/rewardsRecord.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `productId`.',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => '"BONUS", "REALTIME", "REWARDS"',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_history_rewardsrecord' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedHistoryRewardsrecord::class,
                'name' => 'Get Locked Rewards History (USER_DATA)',
                'description' => 'Get Locked Rewards History (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/history/rewardsRecord.',
                'parameters' => [
                    'position_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `positionId`.',
                    ],
                    'asset' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `asset`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_simple_earn_flexible_setautosubscribe' => [
                'class' => BinancePostSapiV1SimpleEarnFlexibleSetautosubscribe::class,
                'name' => 'Set Flexible Auto Subscribe (USER_DATA)',
                'description' => 'Set Flexible Auto Subscribe (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/flexible/setAutoSubscribe.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `productId`.',
                    ],
                    'auto_subscribe' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'true or false',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_simple_earn_locked_setautosubscribe' => [
                'class' => BinancePostSapiV1SimpleEarnLockedSetautosubscribe::class,
                'name' => 'Set Locked Auto Subscribe (USER_DATA)',
                'description' => 'Set Locked Auto Subscribe (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/locked/setAutoSubscribe.',
                'parameters' => [
                    'position_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `positionId`.',
                    ],
                    'auto_subscribe' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'true or false',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_personalleftquota' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexiblePersonalleftquota::class,
                'name' => 'Get Flexible Personal Left Quota (USER_DATA)',
                'description' => 'Get Flexible Personal Left Quota (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/personalLeftQuota.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `productId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_personalleftquota' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedPersonalleftquota::class,
                'name' => 'Get Locked Personal Left Quota (USER_DATA)',
                'description' => 'Get Locked Personal Left Quota (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/personalLeftQuota.',
                'parameters' => [
                    'project_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `projectId`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_subscriptionpreview' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexibleSubscriptionpreview::class,
                'name' => 'Get Flexible Subscription Preview (USER_DATA)',
                'description' => 'Get Flexible Subscription Preview (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/subscriptionPreview.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `productId`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_subscriptionpreview' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedSubscriptionpreview::class,
                'name' => 'Get Locked Subscription Preview (USER_DATA)',
                'description' => 'Get Locked Subscription Preview (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/subscriptionPreview.',
                'parameters' => [
                    'project_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `projectId`.',
                    ],
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `amount`.',
                    ],
                    'auto_subscribe' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'true or false, default true.',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_locked_setredeemoption' => [
                'class' => BinanceGetSapiV1SimpleEarnLockedSetredeemoption::class,
                'name' => 'Set Locked Product Redeem Option(USER_DATA)',
                'description' => 'Set Locked Product Redeem Option(USER_DATA)

Set redeem option for Locked product Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/setRedeemOption.',
                'parameters' => [
                    'position_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `positionId`.',
                    ],
                    'redeem_to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'SPOT,FLEXIBLE, default FLEXIBLE',
                        'enum' => [
                            'SPOT',
                            'FLEXIBLE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_history_ratehistory' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexibleHistoryRatehistory::class,
                'name' => 'Get Rate History (USER_DATA)',
                'description' => 'Get Rate History (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/history/rateHistory.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'query parameter `productId`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_simple_earn_flexible_history_collateralrecord' => [
                'class' => BinanceGetSapiV1SimpleEarnFlexibleHistoryCollateralrecord::class,
                'name' => 'Get Collateral Record (USER_DATA)',
                'description' => 'Get Collateral Record (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/flexible/history/collateralRecord.',
                'parameters' => [
                    'product_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `productId`.',
                    ],
                    'start_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'end_time' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                    'current' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Current querying page. Start from 1. Default:1',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Default:10 Max:100',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_dci_product_list' => [
                'class' => BinanceGetSapiV1DciProductList::class,
                'name' => 'Get Dual Investment product list(USER_DATA)',
                'description' => 'Get Dual Investment product list(USER_DATA)

Get Dual Investment product list Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/dci/product/list.',
                'parameters' => [
                    'option_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Input CALL or PUT',
                        'enum' => [
                            'CALL',
                            'PUT',
                        ],
                    ],
                    'exercised_coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Target exercised asset, e.g.: if you subscribe to a high sell product (call option), you should input: - optionType: CALL, - exercisedCoin: USDT, - investCoin: BNB; if you subscribe to a low buy product (put option), you should input: - optionType: PUT, - exercisedCoin: BNB, - investCoin: USDT;',
                    ],
                    'invest_coin' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Asset used for subscribing, e.g.: if you subscribe to a high sell product (call option), you should input: - optionType: CALL, - exercisedCoin: USDT, - investCoin: BNB; if you subscribe to a low buy product (put option), you should input: - optionType: PUT, - exercisedCoin: BNB, - investCoin: USDT;',
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'MIN 1, MAX 100; Default 100',
                    ],
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_dci_product_subscribe' => [
                'class' => BinancePostSapiV1DciProductSubscribe::class,
                'name' => 'Subscribe Dual Investment products(USER_DATA)',
                'description' => 'Subscribe Dual Investment products(USER_DATA)

Subscribe Dual Investment products - `Products are not available.` means that the APR changes to lower value, or the orders are not available. - `Failed` is a system or network errors. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/dci/product/subscribe.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'get id from /sapi/v1/dci/product/list',
                    ],
                    'order_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'get orderId from /sapi/v1/dci/product/list',
                    ],
                    'deposit_amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'query parameter `depositAmount`.',
                    ],
                    'auto_compound_plan' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'NONE: switch off the plan, STANDARD: standard plan, ADVANCED: advanced plan;',
                        'enum' => [
                            'NONE',
                            'STANDARD',
                            'ADVANCE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_dci_product_positions' => [
                'class' => BinanceGetSapiV1DciProductPositions::class,
                'name' => 'Get Dual Investment positions(USER_DATA)',
                'description' => 'Get Dual Investment positions(USER_DATA)

Get Dual Investment positions (batch) Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/dci/product/positions.',
                'parameters' => [
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => '- PENDING: Products are purchasing, will give results later; - PURCHASE_SUCCESS: purchase successfully; - SETTLED: Products are finish settling; - PURCHASE_FAIL: fail to purchase; - REFUNDING: refund ongoing; - REFUND_SUCCESS: refund to spot account successfully; - SETTLING: Products are settling. If don\'t fill this field, will response all the position status.',
                        'enum' => [
                            'PENDING',
                            'PURCHASE_SUCCESS',
                            'SETTLED',
                            'PURCHASE_FAIL',
                            'REFUNDING',
                            'REFUND_SUCCESS',
                            'SETTLING',
                        ],
                    ],
                    'page_size' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'MIN 1, MAX 100; Default 100',
                    ],
                    'page_index' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Page number, default is first page, start form 1',
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_get_sapi_v1_dci_product_accounts' => [
                'class' => BinanceGetSapiV1DciProductAccounts::class,
                'name' => 'Check Dual Investment accounts(USER_DATA)',
                'description' => 'Check Dual Investment accounts(USER_DATA)

Check Dual Investment accounts Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/dci/product/accounts.',
                'parameters' => [
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
            'binance_post_sapi_v1_dci_product_auto_compound_edit_status' => [
                'class' => BinancePostSapiV1DciProductAutoCompoundEditStatus::class,
                'name' => 'Change Auto-Compound status(USER_DATA)',
                'description' => 'Change Auto-Compound status(USER_DATA)

Change Auto-Compound status - 15:31 ~ 16:00 UTC+8 This function is disabled Weight(IP): 1 Rate Limit: Maximum 1 time/s per account

Official Binance Spot endpoint: POST /sapi/v1/dci/product/auto_compound/edit-status.',
                'parameters' => [
                    'position_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'Get positionId from /sapi/v1/dci/product/positions',
                    ],
                    'auto_compound_plan' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'NONE: switch off the plan, STANDARD: standard plan, ADVANCED: advanced plan;',
                        'enum' => [
                            'NONE',
                            'STANDARD',
                            'ADVANCE',
                        ],
                    ],
                    'recv_window' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The value cannot be greater than 60000',
                    ],
                    'timestamp' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'UTC timestamp in ms',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): BinanceService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new BinanceService(apiKey: $creds->get('binance', 'api_key', '', $account), apiSecret: $creds->get('binance', 'api_secret', '', $account), baseUrl: $creds->get('binance', 'url', 'https://api.binance.com', $account));
        }

        return app(BinanceService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/binance.md'; }
    public function isIntegration(): bool { return true; }
}
