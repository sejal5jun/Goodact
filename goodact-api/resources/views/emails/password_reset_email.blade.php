@extends('emails.email_layout')

@section('title', 'Password Reset')


@section('content')

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;">
      <tr>
        <td align="center" >
          <table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
            <tr>
              <td align="center" bgcolor="#22469c">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <div style="height: 10px; line-height: 10px; font-size: 10px;"></div>
                  <tr>
                    <td ></td>
                    <td >
                    	<a href="#" target="_blank" style="color: #596167; font-family: Arial,Helvetica, sans-serif; float:left; width:30%; padding:20px;text-align:center; font-size: 13px;">
                    		<img src="{{ $message->embed($logo) }}" width="199" alt="Metronic" border="0" />
                    	</a>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" bgcolor="#fff">
                      <table width="90%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>
                            <div style="height:40px; line-height: 60px; "></div>
                            <div style="line-height: 44px;">
                              <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
                                Hi {{ $user->name }},
                              </font>
                            </div>
                            <!-- padding -->
                            <div style="height: 15px; line-height: 30px; font-size: 10px;"></div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div style="line-height: 44px;">
                              <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
                                <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                                  Please click on the link below to reset your account Password -
                                </span>
                              </font>
                            </div>
                            <!-- padding -->
                            <div style="height: 15px; line-height: 30px; font-size: 10px;"></div></td>
                        </tr>
                        <tr>
                          <td style="padding-bottom:30px; height:80px" class="">
                            <a href="{{ $reset_link }}" target="_blank" style="font-family: Helvetica, Arial, sans-serif; text-decoration: none;color: #fff; font-size: 18px; line-height:22px; padding: 14px 18px 14px 18px; background:#009ada; border-radius:10px; margin-bottom:100px" >
                               Reset your Password 
                            </a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>


@endsection