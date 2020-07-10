<?php

class Subject
{

	//IC
    public static $ic_ci = "IC Code No: IC%s Submitted successfully." ;
    public static $ic_coi = "IC Code No: IC%s Consent Required.";

    public static $ic_consent_yes = "IC%s CONSENT - YES";
    public static $ic_consent_no = "IC%s CONSENT - REGRET";

    //FP
    public static $fp_ca = "FP Code No: FP%s Submitted successfully." ;

    //PP
    public static $pp_ca = "PP Code No: PP%s Submitted successfully." ;


    //VT
    public static $vt_ca = "VT Code No: VT%s Submitted successfully." ;

    //ARC
    public static $arc_mail = "ARC Code No : ARC%s submitted successfully" ;

    //Nomination
    public static $Nomination_Proposer_mail = "AIOS-Nomination proposer" ;
    public static $Nomination_Seconder_mail = "AIOS-Nomination seconder" ;
    public static $Nomination_Confirm_mail = "AIOS-NOMINATION CONFIRMATION" ;

    /*Backoffice - Shasmitha*/
    /*IC consent pending reminder mail*/
    public static $IC_pending_consent_reminder         = "Pending consent for Instruction Course(s)";
    public static $IC_pending_consent_reminder_sample  = "Sample - Pending consent for Instruction Course(s)";
    public static $IC_alternate_co_instructor_reminder = "Reminder : Choose Alternate Co-Instructor for your IC";
    public static $IC_alternate_co_instructor_reminder_sample  = "Sample - Reminder : Choose Alternate Co-Instructor for your IC";

    /*Send results -IC 28.06.2017*/
    public static $IC_send_result_selection = "AIOC 2020 -  Instruction Course Selection Announcement";
    public static $IC_send_result_rejection = "AIOC 2020 Instruction Course";

     /*Send results -FP */

    public static $FP_send_result_selection = "AIOC 2020 – FREE PAPER SELECTION ANNOUNCEMENT";
    public static $FP_send_result_rejection = "AIOC 2020 Free Paper";


    public static $PPP_send_result_selection = "AIOC 2020 – PPP Selection - YOUR RESPONSE REQUIRED";

    /*Send results -VT */

    public static $VT_send_result_selection = "AIOC 2020 - VIDEO SELECTION RESULTS";
    public static $VT_send_result_selection_KIOSK = "AIOC 2020 - VIDEO SELECTION FOR KIOSKS";

    /*Send results -PP */
    public static $PP_send_result_selection = "AIOC 2020 Physical Poster";
   
 // public static $ARC_send_result_selection = "AIOC 2018 ARC";
    
    public static $ARC_send_result_selection = "AIOC 2020 - ARC SELECTION RESULTS";
    public static $ARC_send_result_rejection = "AIOC 2020 - ARC RESULTS";

   // public static $Evaluators_invite                   = "Top Priority - Invite to Evaluate ";
    // public static $Evaluators_remind                   = "1 more day to go!";
    // public static $Evaluators_remind_sample            = "Sample - 1 more day to go!";

    //public static $Evaluators_remind         = "IC Evaluation - Last day today";
//public static $Evaluators_remind         = "Hurry! Just 4 more days to go!";
//    public static $Evaluators_remind         = "IC Evaluation - Last date extended upto Sunday";
public static $Evaluators_remind         = "PLEASE HURRY!";

    public static $Evaluators_remind_sample  = "Sample - IC Evaluation - Last day today";
    public static $IC_consented_mail         = "IC CONSENT - YES";

    public static $Evaluators_invite_IC      = "Top Priority - Invite to Evaluate Instruction Course";
    public static $Evaluators_invite_FP      = "Top Priority - Invite to Evaluate Free Paper";
    public static $Evaluators_invite_VT      = "AIOC 2020 - Top Priority - Invite to Evaluate Video Theater";
    public static $Evaluators_invite_ARC     = "Invite to Evaluate ARC PG Thesis";
                                                         
                                                        

    public static $FP_Evaluators_remind      = "FP Evaluation - Last date extended upto Sunday";
    public static $VT_Evaluators_remind      = "PLEASE HURRY!";
    public static $ARC_Evaluators_remind     = "ARC Evaluation - Last date extended upto 03/10/2018";
    // public static $FP_Evaluators_remind               = "1 more day to go!";

   
   /*FP Full text,E-Poster & Physical Poster PPT upload pending mail*/
   public static $FPUpload_Pending = "AIOC 2020 – UPLOAD YOUR FULL TEXT";
   public static $EPUpload_Pending = "AIOC 2020 – UPLOAD YOUR E-POSTER";
   public static $PPPUpload_Pending = "AIOC 2020 – UPLOAD YOUR POSTER PODIUM PRESENTATION";
   public static $PPUpload_Pending = " AIOC 2020 Physical Poster guidelines and powerpoint upload";
   public static $PPUpload_Pending_reminder = "AIOC 2020 - Physical Poster - PPT Upload";
   // public static $PPUpload_Pending = "AIOC 2018 – UPLOAD YOUR PHYSICAL POSTER";
   // public static $FPUpload_Pending = "AIOC 2018 – Last date to upload your Full Text is TODAY!!";
   // public static $EPUpload_Pending = "AIOC 2018 – Last date to upload your E-Poster is TODAY!!";
   
   /*Conversion of PP*/
   public static $Conversion_PP = "AIOC 2020 – CONVERSION OF PHYSICAL POSTER";
  
   /*Hyde park acceptance*/  
   public static $Hydepark_send_result_selection = "HYDE PARK ACCEPTANCE";
   /*Consent judge acceptance*/ 
   /*public static $call_judges  = "AIOS - Consent required for participation as Judge";*/  
   public static $call_judges  = "REQUEST FOR IMMEDIATE RESPONSE";
//public static $call_judges  = "AIOC 2020 - Approval Required. Consent for participation as Chairperson";
   public static $call_judges_pp  = "AIOC 2020 - Approval Required. Consent for participation as Judge";

    /*E-Poster Selection Result*/  
   public static $Eposter_send_result_selection = "AIOC 2020 – E-POSTER SELECTION RESULTS";

     /*Consented judge acceptance*/  
    public static $consented_judges  = "AIOS - Thank you for consenting to judge the physical posters";
    /*Commitment Mailer*/
    
public static $Commitment = "Your Final Commitments";
    /*Invite Evaluate Judges*/
    public static $Evaluators_invite_FP_judges = "AIOC 2020 - Chairperson for a FP Session";
    public static $Evaluators_remind_FP_judges = "AIOC 2020 - Chairperson for a FP Session";
    /*Physical Poster Judges*/
   public static $PPJudges = "AIOC 2020 - Judges for a Physical Poster Session";

    public static $PP_Authors = "AIOC 2020 - Letter to participants of physical poster session";

    public static $PresDevice    = "AIOC 2020 - To select presentation device";
    public static $PresDeviceAck = "AIOC 2020 - Acknowledgement of presentation device";


    /*Send change Request - FP */
    public static $FP_send_change_request = "​AIOC 2020.  Authorship roles changes required?";
}
