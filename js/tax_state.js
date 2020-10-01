// disable back button
window.history.forward(1);
// timeout functionality
setTimeout("checkTimeout()", 840000) ; //Count Time 14 Min
var a = 0;
var greaterthanflag = null;
var greaterthantotflag = null;
var NetclmamtCounter = 0;
var Checkboxselectedflag = null;
var Setdecflag = null;
var decflagCounter = 0;
var removeCheckBox = null;
var newcheckboxFlag = null;
var newcheckboxflagCounter = 0;
var newtextFlag = null;
var disableSubmitFlag = null;
var submitFlag = null;
var changenetclmflag = null;
var changeadclmflag = null;

function checkTimeout() {
    newWindow = window.open('/EssTax/timeout.do', 'EssTax',
    'scrollbars=yes,resizable=yes,toolbar=0,menubar=0,width=400,height=400,left=25,top=25');
    newWindow.focus();
}

function loadSnapshot(frm) {
    var retVal;
    if ("US" == "CA") {} else {
        retVal = getSnapshotGeneric(frm);
        frm.oldSnapshot.value = retVal;
        return retVal;
    }
}

function strTrim(oldValue) {
    return oldValue.replace(/^\s+/, '').replace(/\s+$/, '');
}

function zeroTrim(oldValue) {
    if (oldValue == '') {
        return '';
    }
    var trimmed = oldValue.replace(/^0+/, '');
    if (trimmed == '') {
        return '0';
    }
    if (trimmed.charAt(0) == '.') {
        return '0' + trimmed;
    }
    return trimmed;
}

function fmtAsCurrency(oldValue) {
    return '' + parseFloat(strTrim(oldValue)).toFixed(2);
}

function fmtAsNumeric(oldValue) {
    return '' + parseInt(strTrim(oldValue));
}

function massageFederalForm() {
    var exempt1 = document.getElementsByName('federalWithholdings[0].exemptions')[0];
    var exempt2 = document.getElementsByName('federalWithholdings[1].exemptions')[0];
    var addlTax1 = document.getElementsByName('federalWithholdings[0].additionalTaxAmount')[0];
    var addlTax2 = document.getElementsByName('federalWithholdings[1].additionalTaxAmount')[0];
    if (exempt1) {
        exempt1.value = fmtAsNumeric(exempt1.value);
    }
    if (exempt2) {
        exempt2.value = fmtAsNumeric(exempt2.value);
    }
    if (addlTax1) {
        addlTax1.value = fmtAsCurrency(addlTax1.value);
    }
    if (addlTax2) {
        addlTax2.value = fmtAsCurrency(addlTax2.value);
    }
}

function massageStateForm() {
    var dep1 = document.getElementsByName('stateWithholdings[0].dependents')[0];
    var dep2 = document.getElementsByName('stateWithholdings[1].dependents')[0];
    var addlTax1 = document.getElementsByName('stateWithholdings[0].additionalTaxAmount')[0];
    var addlTax2 = document.getElementsByName('stateWithholdings[1].additionalTaxAmount')[0];
    if (dep1) {
        dep1.value = fmtAsNumeric(dep1.value);
    }
    if (dep2) {
        dep2.value = fmtAsNumeric(dep2.value);
    }
    if (addlTax1) {
        addlTax1.value = fmtAsCurrency(addlTax1.value) ;
    }
    if (addlTax2) {
        addlTax2.value = fmtAsCurrency(addlTax2.value);
    }
}

function getSnapshotGeneric(frm) {
    var elementsArr = frm.elements;
    var snapshot = '';
    for (i = 0; i < elementsArr.length; i++) {
        if ((elementsArr[i].type != "checkbox") &&
        (elementsArr[i].type != "submit") &&
        (elementsArr[i].type != "button") &&
        (elementsArr[i].type != "hidden") &&
        (elementsArr[i].type != "radio")) {
            snapshot += elementsArr[i].value;
        }
    }
    return snapshot;
}

function getSnapshotFederal() {
    return getSnapshotGeneric(document.federalTaxInfoBean);
}

function getSnapshotState() {
    return getSnapshotGeneric(document.stateTaxInfoBean);
}

function submitFormGeneric(tOldSnapshot, frm) {
    var newSnapshot = getSnapshotGeneric(frm);
    if (newSnapshot == tOldSnapshot) {
        if ((!frm.claimExemption.checked) && (!frm.noClaimExemption.checked)) {
            alert("There were no updates to the form, please make changes and then select Submit or select the Exit button to leave the form.");
            return false;
        }
    }
    if (!frm.declaration.checked) {
        alert('To continue, you must agree to the declaration above and check the box.');
        return false;
    }
    frm.button1.value = "Processing";
    frm.button1.disabled = "disabled";
    return true;
}

function submitCAFormGeneric(frm) {
    //var newSnapshot = getSnapshotGeneric(frm);
    //if (newSnapshot == tOldSnapshot) {
    if ((!frm.claimExemption.checked) && (!frm.noClaimExemption.checked)) {
        alert("There were no updates to the form, please make changes and then select Submit or select the Exit button to leave the form.");
        return false;
    }
    //}
    if (!frm.declaration.checked) {
        alert('To continue, you must agree to the declaration above and check the box.');
        return false;
    }
    frm.button1.value = "Processing";
    frm.button1.disabled = "disabled";
    return true;
}

function submitFederalForm(tOldSnapshot) {
    return submitFormGeneric(tOldSnapshot, document.federalTaxInfoBean);
}

function submitStateForm(tOldSnapshot) {
    return submitFormGeneric(tOldSnapshot, document.stateTaxInfoBean);
}

function validateFormGeneric(frm) {
    var elementsArr = frm.elements;
    var isNumberPattern = /^\d{1,7}$/;
    var isFloatPattern = /^\d{1,7}\.\d?\d?$/;
    var exmptPattern = /^[1-2][0-9]?$/;
    var singleDigitPattern = /^\d$/;
    var alertErrors = '';
    var elementOffset = 0;
    if (frm.name == 'federalTaxInfoBean') {
        elementOffset = 'federalWithholdings[N].'.length;
    } else if (frm.name == 'stateTaxInfoBean') {
        elementOffset = 'stateWithholdings[N].'.length;
    }
    for (i = 0; i < elementsArr.length; i++) {
        if ((elementsArr[i].type != "checkbox") &&
        (elementsArr[i].type != "submit") &&
        (elementsArr[i].type != "button") &&
        (elementsArr[i].type != "hidden") &&
        (elementsArr[i].type != "radio")) {
            var elementName = elementsArr[i].name.substring(elementOffset, elementsArr[i].name.length);
            var elementValue = zeroTrim(strTrim(elementsArr[i].value));
            if (elementName == "exemptions" || elementName == "dependents") {
                if (elementValue == '') {
                    alertErrors += 'Missing number of exemptions.\n';
                } else if (elementValue.match(isNumberPattern) == null) {
                    alertErrors += 'Exemptions field must be a number.\n';
                } else if ((elementValue != '0') &&
                (elementValue != '30') &&
                (elementValue.match(singleDigitPattern) == null) &&
                (elementValue.match(exmptPattern) == null)) {
                    alertErrors += 'Please enter a reasonable number of exemptions.\n';
                }
            } else if (elementName == "additionalTaxAmount") {
                if (elementValue == '') {
                    elementsArr[i].value = '0.00';
                } else if (elementValue.match(isFloatPattern) == null) {
                    if (elementValue.match(isNumberPattern) == null) {
                        alertErrors += 'Additional Tax Amount field must be a number.\n';
                    }
                }
            }
        }
    }
    //error getting
    if (alertErrors == '') {
        if (frm.name == 'federalTaxInfoBean') {
            massageFederalForm();
        } else {
            massageStateForm();
        }
        return true;
    }
    alert(alertErrors);
    return false;
}

function validateFederalForm() {
    return validateFormGeneric(document.federalTaxInfoBean);
}

function validateStateForm() {
    return validateFormGeneric(document.stateTaxInfoBean);
}

function checkStringValue() {
    CnfExit = 'You have made changes to your information but have not selected the "Submit" button. If you exit now, your changes will not be saved.';
    return CnfExit;
}

function checkStringValue2() {
    CnfExit = new String("");
    return CnfExit;
}

function confirmExit() {
    var cfmExit = true;
    var oldsnap;
    var newsnap;
    var showCfrmWindow = false;
    var CnfExit = "";
    //var abc=new String("You have made changes to your information but have not selected the "Submit" button. If you exit now, your changes will not be saved.");
    //CnfExit=abc.toString();
    if ("US" == "CA") {
        if ("en_US" == "fr_CA") {
            CnfExit = checkStringValue2();
        } else {
            CnfExit = checkStringValue();
        }
        if (changenetclmflag == "SET") {
            showCfrmWindow = true;
        } else if (changeadclmflag == "SET") {
            showCfrmWindow = true;
        } else if (newcheckboxFlag == "SET") {
            showCfrmWindow = true;
        } else {
            showCfrmWindow = false;
        }
    } else {
        if (document.federalTaxInfoBean) {
            oldsnap = document.federalTaxInfoBean.oldSnapshot.value;
            newsnap = getSnapshotFederal();
            showCfrmWindow = (oldsnap != newsnap ||
            document.federalTaxInfoBean.claimExemption.checked ||
            document.federalTaxInfoBean.noClaimExemption.checked);
        } else if (document.stateTaxInfoBean) {
            oldsnap = document.stateTaxInfoBean.oldSnapshot.value;
            newsnap = getSnapshotState();
            showCfrmWindow = (oldsnap != newsnap ||
            document.stateTaxInfoBean.claimExemption.checked ||
            document.stateTaxInfoBean.noClaimExemption.checked);
        } else {
            return true;
        }
    }
    if (showCfrmWindow) {
        cfmExit = confirm(CnfExit);
    }
    return cfmExit;
}

function validateCAFormGeneric(addclmamt, totclmamt) {
    greaterthanflag = null;
    disableSubmitFlag = null;
    greaterthantotflag = null;
    disableSubmitFlag = null;
    var isNumberPattern = /^\d{1,10}$/;
    var isFloatPattern = /^\d{1,10}\.\d?\d?$/;
    var exmptPattern = /^[1-2][0-9]?$/;
    var singleDigitPattern = /^\d$/;
    var alertErrors = '';
    var elementOffset = 0;
    var addClmamt = addclmamt.value;
    var totClmamt = totclmamt.value;
    var checkNetClmGrtFlag = null;
    var checkAddClmGrtFlag = null;
    if ("en_US" == "fr_CA") {
        addClmamt = addClmamt.replace(",", ".");
        totClmamt = totClmamt.replace(",", ".");
    }
    if (addClmamt == "") {
        addClmamt = "0.00";
        newtextFlag = null;
        //alertErrors += 'Please enter valid Additional Tax Amount in decimal format, i.e 6.00.\n';
    }
    if (totClmamt == "") {
        totClmamt = "0.00";
        newtextFlag = null;
    }
    if (totClmamt != "0.00")
    {
        if ("" == "P")
        {
            if ("" == "Yes")
            {
                if (newcheckboxFlag == "SET") {
                } else {
                    alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                    return false;
                }
            } else
            {
                if (newcheckboxFlag == "SET") {
                    alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                    return false;
                }
            }
        } else
        {
            if ("" == "Yes") {
                if (newcheckboxFlag == "SET") {
                } else
                {
                    alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                    return false;
                }
            } else
            {
                if (newcheckboxFlag == "SET") {
                    alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                    return false;
                }
            }
        }
    } else if (addClmamt != "0.00")
    {
        if ("" == "P")
        {
            if ("" == "Yes")
            {
                if (newcheckboxFlag == "SET")
                {
                } else
                {
                    alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                    return false;
                }
            } else
            {
                if (newcheckboxFlag == "SET")
                {
                    //set additional amount to 0.00 if Total income less than total claim amount checkbox is checked
                    //and additional amount is not displayed because the person is not in Quebec
                    if ("" == "False")
                    {
                        document.getElementById("addClmAmt").value = "0.00";
                    } else
                    {
                        alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                        return false;
                    }
                }
            }
        } else
        {
            if ("" == "Yes") {
                if (newcheckboxFlag == "SET") {
                } else
                {
                    alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                    return false;
                }
            } else
            {
                if (newcheckboxFlag == "SET")
                {
                    alert('If income<total claim amount, please do not enter amounts in the Total Claim field or Additional Tax Amount field.');
                    return false;
                }
            }
        }
    }
    var a = addClmamt.indexOf(".");
    var b = totClmamt.indexOf(".");
    var intaddclm = addClmamt.substr(0, a);
    var intotclm = totClmamt.substr(0, b);
    if (a == -1) {
        var addCLMamt = addClmamt;
    } else {
        var addCLMamt = new String(intaddclm);
    }
    if (b == -1) {
        var totCLMamt = totClmamt;
    } else {
        var totCLMamt = new String(intotclm);
    }
    var oldtaxaddt = " ";
    var oldtxntclm = " ";
    var taxflag = "";
    if ("" == "P") {
        oldtaxaddt = "";
        oldtxntclm = "";
    } else {
        oldtaxaddt = "";
        oldtxntclm = "";
    }
    check9999(addCLMamt, totCLMamt);
    if (greaterthanflag == "SET") {
        alertErrors += 'Additional Tax Amount must be less than 99999 dollars \n';
    }
    if (greaterthantotflag == "SET") {
        alertErrors += 'Total Claim Amount must be less than 99999 dollars\n';
    }
    if ("" == "P") {
        if ("en_US" == "fr_CA") {
            addClmamt = addClmamt.replace(".", ",");
            totClmamt = totClmamt.replace(".", ",");
        }
        if (totClmamt == "") {
            if (addClmamt == "") {
                if ("" == "Yes") {
                    if (newcheckboxFlag == null) {
                        alertErrors += "There were no updates to the form, please make changes and then select Submit or select the Exit button to leave the form.\n";
                    }
                } else {
                    if (newcheckboxFlag == null) {
                        alertErrors += "There were no updates to the form, please make changes and then select Submit or select the Exit button to leave the form.\n";
                    }
                }
            }
        }
        addClmamt = addClmamt.replace(",", ".");
        totClmamt = totClmamt.replace(",", ".");
    } else {
        if ("en_US" == "fr_CA") {
            addClmamt = addClmamt.replace(".", ",");
            totClmamt = totClmamt.replace(".", ",");
        }
        if (totClmamt == "") {
            if (addClmamt == "") {
                if ("" == "Yes") {
                    if (newcheckboxFlag == null) {
                        alertErrors += "There were no updates to the form, please make changes and then select Submit or select the Exit button to leave the form.\n";
                    }
                } else {
                    if (newcheckboxFlag == null) {
                        alertErrors += "There were no updates to the form, please make changes and then select Submit or select the Exit button to leave the form.\n";
                    }
                }
            }
        }
        addClmamt = addClmamt.replace(",", ".");
        totClmamt = totClmamt.replace(",", ".");
    }
    if (addClmamt == '') {
        addClmamt = "0.00";
    } else if (addClmamt.match(isFloatPattern) == null) {
        if (addClmamt.match(isNumberPattern) == null) {
            alertErrors += 'Please enter valid Additional Tax Amount in decimal format, i.e 6.00.\n';
        } else {
        }
    }
    if (totClmamt == '') {
        totClmamt = "0.00";
        setadditonalClmamtvalues();
    } else if (totClmamt.match(isFloatPattern) == null) {
        if (totClmamt.match(isNumberPattern) == null) {
            alertErrors += 'Please enter valid Total Claim Amount in decimal format, i.e 6.00.\n';
        } else {
        }
    }
    if (Setdecflag == null) {
        alertErrors += 'To continue, you must agree to the declaration above and check the box.\n';
    }
    if (alertErrors == '') {
        disableSubmitFlag = "SET";
        submitFlag = "SET";
        return true;
    } else {
        alert(alertErrors);
        return false;
    }
}

function check9999(addCLMamt, totCLMamt) {
    greaterthanflag = null;
    greaterthantotflag = null;
    if (addCLMamt > 99998) {
        greaterthanflag = "SET";
    }
    if (totCLMamt > 99998) {
        greaterthantotflag = "SET";
    }
}

function validateAddAmntFed() {
    if (newtextFlag == "SET") {
        return false;
    }
    Checkboxselectedflag = null;
    a++;
    if (a == 1) {
        if ("" == "No")
        {
            a++;
        } else if ("" == "No") {
            a++;
        } else {}
    }
    if (a % 2 == 0) {
        Checkboxselectedflag = "SET";
        return false;
    }
    Checkboxselectedflag = "null";
    return false;
}

function validateNetAmntFed() {
    if (newtextFlag == "SET") {
        return false;
    }
    Checkboxselectedflag = null;
    NetclmamtCounter++;
    if (NetclmamtCounter == 1) {
        if ("" == "No")
        {
            NetclmamtCounter++;
        } else if ("" == "No") {
            NetclmamtCounter++;
        } else {}
    }
    if (NetclmamtCounter % 2 == 0) {
        Checkboxselectedflag = "SET";
        return false;
    }
    Checkboxselectedflag = null;
    return false;
}

function checkboxvalidaton(addCLMAMT, totCLMAMT) {
    disableSubmitFlag = null;
    var totClmamt = totCLMAMT.value;
    var addClmamt = addCLMAMT.value;
    if (totClmamt == "") {
        totClmamt = "0.00";
    }
    if (addClmamt == "") {
        addClmamt = "0.00";
    }
    removeCheckBox = null;
    newcheckboxFlag = null;
    var alertErrors = '';
    newcheckboxflagCounter++;
    if ("" == "P") {
        if ("" == "Yes") {
            if (newcheckboxflagCounter == 1) {
                //newcheckboxflagCounter++;
                newcheckboxFlag = "SET";
            }
        } else {
            newcheckboxflagCounter++;
            newcheckboxflagCounter++;
        }
    } else if ("" == "F") {
        if ("" == "Yes") {
            if (newcheckboxflagCounter == 1) {
                newcheckboxFlag = "SET";
                //newcheckboxflagCounter++;
            }
        } else {
            newcheckboxflagCounter++;
            newcheckboxflagCounter++;
        }
    }
    if (newcheckboxflagCounter != 1) {
        if (newcheckboxflagCounter % 2 == 0) {
            newcheckboxFlag = null;
        } else {
            newcheckboxFlag = "SET";
        }
    }
}

function setadditonalClmamtvalues() {
    if (Checkboxselectedflag == "SET") {
        if (removeCheckBox == "SET") {
            if ("" == "P") {
                var oldtaxaddt = "";
            } else {
                var oldtaxaddt = "";
            }
        } else {
            var oldtaxaddt = "0.00";
        }
    } else {
        if ("" == "P") {
            var oldtaxaddt = "";
        } else {
            var oldtaxaddt = "";
        }
    }
    return oldtaxaddt;
}

function setNetClmAmntFed() {
    if (Checkboxselectedflag == "SET") {
        if (removeCheckBox == "SET") {
            if ("" == "P") {
                var oldtxntclm = "";
            } else {
                var oldtxntclm = "";
            }
        } else {
            var oldtxntclm = "0.00";
        }
    } else {
        if ("" == "P") {
            var oldtxntclm = "";
        } else {
            var oldtxntclm = "";
        }
    }
    return oldtxntclm;
}

function setDeclarationflag() {
    decflagCounter++;
    if (decflagCounter % 2 == 0) {
        Setdecflag = null;
        return false;
    }
    Setdecflag = "SET";
    return true;
}

function disbableButton() {
    if (disableSubmitFlag == "SET") {
        return true;
    }
    return false;
}

function call() {
    var p = "Submit";
    if (submitFlag == "SET") {
        if (Setdecflag == "SET") {
            p = "Processing";
            return p;
        }
    }
    return p;
}

function validiateCAform() {
    if (submitFlag == "SET") {
        if (Setdecflag == "SET") {
            return true;
        }
    }
    return false;
}

function setAddClmFlag() {
    changeadclmflag = "SET";
}

function setNetClmFlag() {
    changenetclmflag = "SET";
}
