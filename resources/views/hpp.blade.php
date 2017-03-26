<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <!--
        *ProPay provides the following code “AS IS.” 
        *ProPay makes no warranties and ProPay disclaims all warranties and conditions, express, implied or statutory, 
         including without limitation the implied warranties of title, non-infringement, merchantability, and fitness for a particular purpose. 
        *ProPay does not warrant that the code will be uninterrupted or error free, 
         nor does ProPay make any warranty as to the performance or any results that may be obtained by use of the code.
    --> 
    <head>
        <style>
            table{width: 100%; table-layout: fixed}
            .iFrame {text-align: center; width:90%; height:720px; overflow-y:scroll; padding:10px;}
            .BrowserMessageBox {width: 98%; height:200px;border:1px solid grey;overflow-x: scroll;overflow-y: scroll;padding:10px;font-size:13px;}
            .MessageBox {width: 98%;height:200px;border:1px solid blue;overflow-x: scroll;overflow-y: scroll;padding:10px;font-size:13px;}
            .ConsoleBox {width: 98%;height:200px;border:1px solid green;overflow-x: scroll;overflow-y: scroll;padding:10px;font-size:13px;}
            .SubmitButtonDisabled {width: 100px;height: 35px;margin-top: 10px;margin-bottom: 10px;border: 2px solid #800000;background-color: #EFD7D7;font-weight: bold;}
            .SubmitButtonEnabled {width: 100px;height: 35px;margin-top: 10px;margin-bottom: 10px;border: 2px solid #008000;background-color: #CAF7CA;font-weight: bold;}
            .ClearButton { width: 62px; height: 20px; border: 1px solid black; background-color: #E9E9FD; margin-top: 7px; margin-bottom: 2px;}   
        </style>
        <title>Hosted Payment Page Development Tool</title>
    </head>
    <body>
        <div role="main" style="margin: 0 1.5%">
            <h3><u>Hosted Payment Page Development Tool</u></h3>
            <table>
                <tr>
                    <td>
                        <span><b>Base URI: </b></span>
                        <span id="baseURI"></span>
                    </td>
                    <td style="text-align: left"><b>SignalR Server URI: </b><span id="SignalRURI"></span></td>
                </tr>
                <tr>
                    <td>
                        <span><b>HostedTransactionIdentifier: </b></span>
                        <input type="text" size="38" id="HID" />
                        <button type="button" id="btnStart" style="margin-right: 01.5%; text-align: right" onclick="btnStart_Click()">Start</button>
                    </td>
                     <td style="text-align: left"><b>Hosted Payment Page URI: </b><span id="HPPURI"></span></td>
                </tr>
                <tr style="height: 10px"></tr>
                <tr>
                    <th>Hosted Payment Page</th>   
                    <th style="text-align: left">Browser Messages</th>   
                </tr>
                 <tr>
                    <td rowspan="7" style="vertical-align: top; text-align: center">
                        <iframe id="hppFrame" name="hppFrame" class="iFrame"></iframe> 
                    </td>
                    <td style="width: 49%;">
                        <div id="BrowserLog" class="BrowserMessageBox"></div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 49%; text-align: right" style="vertical-align: top;"><input type="button" value="Clear" class="ClearButton" onclick="btnClearMessage_Click()" /></td>
                </tr>
                <tr>
                    <th style="text-align: left">SignalR Messages</th>
                </tr>
                <tr>
                    <td>
                        <div id="MessageLog" class="MessageBox"></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49%; text-align: right"  style="vertical-align: top;"><input type="button" value="Clear" class="ClearButton" onclick="btnClearBrowser_Click()" /></td>
                </tr>
                <tr>
                    <th style="text-align: left">SignalR Console Messages</th> 
                </tr>
                <tr>
                    <td style="vertical-align: top;">
                        <div id="ConsoleLog" class="ConsoleBox"></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49%; text-align: right"><input type="button" id="btnSubmit" name="btnSubmit" value="Submit" class="SubmitButtonDisabled" onclick="btnSubmitForm_Click()" disabled="disabled" /></td>
                    <td style="width: 49%; text-align: right"  style="vertical-align: top;"><input type="button" value="Clear" class="ClearButton" onclick="btnClearLog_Click()" /></td>
                </tr>
            </table>
        </div>
        <footer style="display: none;">
        </footer>
        <script type="text/javascript">
            /*=======================================================================================================
            The following functions are referenced by the hpp.js file and should be included on your checkout page
            ========================================================================================================*/

            //How to load the HPP 
            function loadHPP(HID) {
                hpp_Load(HID, true); //HostedTransactionIdentifier, Debug Mode
            }

            //Submit Button Function
            function btnSubmitForm_Click() {
                signalR_SubmitForm();
            }

            //This function is invoked when the Hosted Payment Page and the Checkout Page are connected and the Hosted Payment Page is ready for submission
            function formIsReadyToSubmit() {
                //Do not allow the user to submit the Hosted Payment Page until this Method has been invoked
                document.getElementById('btnSubmit').disabled = false;
                document.getElementById('btnSubmit').className = 'SubmitButtonEnabled';
                document.getElementById('btnStart').disabled = true;
            }

            /*==========================================================================================================
            The following functions are used by this development page only and should not be used by your checkout page 
            =============================================================================================================*/

            //Development Page Functions
            onload = function () {
                //Get the global variable that is defined in the hpp.js file
                if (baseURI == null) {
                    alert("baseURI is not Defined, Is the hpp.js file correctly loaded?")
                    return;
                }
                document.getElementById("baseURI").innerHTML = baseURI;
            }

            //Start Click Button Event
            function btnStart_Click() {
                //Get Values and Validate
                if (baseURI == null) {
                    alert("baseURI is not Defined, Is the hpp.js file correctly loaded?")
                    return;
                }
                var HID = document.getElementById('HID').value;
                if (HID == "") { alert("HostedTransactionIdentifier cannot be blank!"); return; }
                else {
                    //Setup Console Object
                    var console = window.console || { log: function () { } };
                    console.log = function () { }
                    //Load HPP
                    document.getElementById('SignalRURI').innerHTML = '<u>' + signalrURI + '/negotiate?clientProtocol=1.5&hid=' + HID + 'c=0&connectionData=[{"name":"hostedtransaction"}]</u>';
                    document.getElementById('HPPURI').innerHTML = '<u>' + hppURI + HID + '</u>'
                    loadHPP(HID);
                    return false;
                }
            }

            //Clear Log Screen
            function btnClearBrowser_Click() {
                document.getElementById('BrowserLog').innerHTML = '';
            }

            //Clear Log Screen
            function btnClearMessage_Click() {
                document.getElementById('MessageLog').innerHTML = '';
            }

            //Clear Log Screen
            function btnClearLog_Click() {
                document.getElementById('ConsoleLog').innerHTML = '';
            }

            //Get Timestamp for log
            function GetTimestamp() {
                var date = new Date();
                var hour = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                var milliseconds = date.getMilliseconds();
                if ((minutes + '').length == 1) {
                    minutes = '0' + minutes;
                }
                if ((seconds + '').length == 1) {
                    seconds = '0' + seconds;
                }
                if ((milliseconds + '').length == 1) {
                    milliseconds = '00' + milliseconds;
                }
                if ((milliseconds + '').length == 2) {
                    milliseconds = '0' + milliseconds;
                }
                return hour + ':' + minutes + ':' + seconds + ':' + milliseconds;
            }

            //Echo Browser Events to Browser Log Window
            function echoBrowserMessage(message) {
                var divMessage = document.getElementById('BrowserLog');
                var msg = divMessage.innerHTML;
                msg = '[' + GetTimestamp() + '] ' + message + '<br />' + msg;
                divMessage.innerHTML = msg;
            }

            //Echo SignalR Message and Data Events to Log Window
            function echoSignalRMessage(message) {
                var divMessage = document.getElementById('MessageLog');
                var msg = divMessage.innerHTML;
                msg = '[' + GetTimestamp() + '] ' + message + '<br />' + msg;
                divMessage.innerHTML = msg;
            }

            //Echo SignalR Console Transport Connection Events to Log Window
            function echoSignalRConsoleMessage(message) {
                var divMessage = document.getElementById('ConsoleLog');
                var msg = divMessage.innerHTML;
                msg = '<b>[' + GetTimestamp() + ']</b> ' + message + '<br />' + msg;
                divMessage.innerHTML = msg;
            }
        </script>
        <!-- jQuery must be loaded before signalR-->
        <script src="/js/jquery-2.2.2.min.js" type="text/javascript"></script>
        <script src="/js/jquery.signalR-2.2.0.min.js" type="text/javascript"></script>
        <script src="/js/hpp-1.1.js" type="text/javascript"></script>
    </body>
</html>