<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#003366">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">



<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#003366">
  <tr>
    <td valign="top" align="center" style="font-size: 12px; color: #000000; line-height: 150%; font-family: Open Sans,Tahoma, Geneva, sans-serif;">
    <table width="640" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff; border-bottom: 1px solid #000;
padding-bottom: 10px;">
        <tr valign="middle">
          <!-- <td> -->
          <td
            align="left"
            style="background-color: #F4DD51; line-height: 0px; font-size: 12px; color: #000000; font-family: Open Sans,Tahoma, Geneva, sans-serif; background-color: #ffffff; border: none;margin-bottom:10px;" bgcolor="#ffffff">
              <img src="{{asset('images/vrsi_logo.png')}}" alt="VRSI"   style = "height:100px;width:auto;" border="0" style=" outline: 0px !important; border: none;text-align:left;">
            </td>
            
        </tr>
        <tr valign="middle">
          <td align="center" style="line-height: 0px; font-size: 12px; color: #000000; font-family: Open Sans,Tahoma, Geneva, sans-serif; background-color: #003366; border: none;" bgcolor="#003366">
          <table width="640" border="0" cellspacing="0" cellpadding="15" bgcolor="#ffffff">
            <tbody>
              <tr>
                <td style="font-size: 12px; color: #000000; line-height: 150%; font-family: Open Sans,Tahoma, Geneva, sans-serif;">
<p style="font-size: 16px; color: #000000; line-height: 24px; text-align: justify; font-family: Open Sans,Tahoma, Geneva, sans-serif;" align="justify">Dear {{ $u->prefix or 'Dr'}} {{ $u->full_name or ''}},</p>
                  <p style="font-size: 16px; color: #000000; line-height: 24px; text-align: justify; font-family: Open Sans,Tahoma, Geneva, sans-serif;" align="justify">{{ $OTPContent }}
                 <br />

                  </p>.
</td>
              </tr>
            </tbody>
          </table>
</td>
        </tr>
      </table>
      </td>
  </tr>
</table>

</body>
</html>
