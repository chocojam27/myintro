<div style="width: 90%; padding: 50px 30px 35px; background-size: cover; background-repeat: no-repeat; background-position: center; background-color: #dedede;">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="text-transform:uppercase; font-size: 28px; font-family: Helvetica,Arial,sans-serif; color:#055161; font-weight: 700;">
            New Contact Message
        </h2>
    </div>
    <div style="background: rgba(255,255,255,0.8); min-height: 650px; padding:30px;">
        <div style=" background: rgba(255,255,255,0.9); min-height: 103px; padding:25px 35px 15px; margin-bottom: 15px;">
            <h2 style="font-family:Helvetica,Arial,sans-serif; font-size: 22px; color:#3f3f3f; margin:0;">
                <strong style="font-weight:700;">
                    Information Details:
                </strong>
            </h2>
            <hr style="margin: 15px 0 20px; color:transparent; border-bottom: 1px solid #eaeced;">
            <div style="text-align:left;width:100%;">
                <div style="font-size: 15px;width: 48%;clear:both;display: inline-flex;color:#3f3f3f;margin-bottom: 20px;">
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1;width: 30%;">
                        <strong style="font-weight:700;">
                            Name:
                        </strong>
                    </h2>
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1;width: 70%;font-weight: 500;">
                        {!! $name !!}
                    </h2>
                </div>
                <div style="font-size: 15px;width: 48%;clear:both;display: inline-flex;color:#3f3f3f;margin-bottom: 20px;">
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1;width: 30%;">
                        <strong style="font-weight:700;">
                            Email:
                        </strong>
                    </h2>
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1;width: 70%;font-weight: 500;">
                        {!! $email !!}
                    </h2>
                </div>
                <div style="font-size: 15px;width: 48%;clear:both;display: inline-flex;color:#3f3f3f;margin-bottom: 20px;">
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1;width: 30%;">
                        <strong style="font-weight:700;">
                            Subject:
                        </strong>
                    </h2>
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1;width: 70%;font-weight: 500;">
                        {!! $subject !!}
                    </h2>
                </div>
            </div>
            <div style="text-align: left;width:100%;">
                <div style="font-size: 15px;width: 100%;clear:both;display: inline-flex;color:#3f3f3f;margin-bottom: 20px;">
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1;width: 15%;">
                        <strong style="font-weight:700;">
                            Message:
                        </strong>
                    </h2>
                    <h2 style="font-family:Helvetica,Arial,sans-serif;line-height: 1.5;width: 85%;font-weight: 500;">
                    {!! $content !!}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
