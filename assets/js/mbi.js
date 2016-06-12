/**
 * @return {null}
 */
function CalcIt(form) {
    var Age    = Number(form.Years.value);
    var weight = Number(form.wt.value);
    if (!checkWeight(weight))return false;
    if (form.wu.selectedIndex == 0) {
        kg = weight * 0.45359237;
    } else {
        kg = weight;
    }
    if (kg < 10) {
        alert("يجب أن يكون الوزن أثقل من 10 كغ (22 رطلاً)");
        return false;
    }
    if (kg > 200) {
        alert("يجب أن يكون الوزن أخف من 200 كغ (441 رطلاً)");
        return false;
    }
    var height = Number(form.ht.value);
    if ((isNaN(height)) || (height == null) || (height == "") || (height < 0)) {
        feetAndInches(form);
        height = Number(form.ht.value);
    }
    if (form.hu.selectedIndex == 0) {
        heightInches = height;
        heightMeters = height * 2.54 / 100;
    } else {
        heightInches = height / 2.54;
        heightMeters = height / 100;
    }
    if (heightMeters < 0.33) {
        alert("يجب أن يكون الطول أكثر من 33 سم (31.5 بوصة)");
        return false;
    }
    if (heightMeters > 2.41) {
        
        alert("الطول يجب أن يكون أقل من 241 سم (7 أقدام و 11 بوصة)");
        return false;
    }
    setFeetAndInches(form, heightInches);
    var cm = heightMeters * 100;
    if ((isNaN(Age)) || (Age == null) || (Age == ""))Age = GetAge(form, cm);
    if (Age < 1) {
        alert("الأعمار الأصغر من 1 سنة هي صغيرة جداً بحيث لا نستطيع حسابها. نعتذر عن ذلك");
        return false;
    } else {
        if (Age > 120) {
            alert("يتم التعامل مع جميع الأعمار من 70 إلى 120 وكأنها 75 ");
            Age              = 75;
            form.Years.value = 75;
        }
    }
    SetAgeCat(form, Age);
    if (form.Gender.selectedIndex == 0) {
        if (Age < 12 && cm > 170) {
            alert("الطول يبدو أكثر من العمر, لذلك تم تغيير العمر");
            Age              = 25;
            form.Years.value = Age;
        }
        if (cm < 155 && Age > 17) {
            alert("الطول يبدو قليل جداً بالنسبة للعمر, لذلك تم تغيير العمر");
            Age              = rounding((0.0003 * cm * cm) + (0.0847 * cm) - 7.5544, 1);
            form.Years.value = Age;
        }
    } else {
        if (Age < 12 && cm > 170) {
            alert("الطول يبدو أقصر بالنسبة للعمر, لذلك تم تغيير العمر");
            Age              = 25;
            form.Years.value = Age;
        }
        if (cm < 145 && Age > 17) {
            alert("الطول يبدو أقل بكثير بالنسبة للعمر لذا تم تغيير العمر");
            Age              = rounding((0.0007 * cm * cm) - (0.0136 * cm) - 1.6819, 0);
            form.Years.value = Age;
        }
    }
    bmi            = kg / Math.pow(heightMeters, 2);
    form.bmi.value = rounding(bmi, 1);
    var b85        = 25;
    var b05        = 17;
    var b95        = 30;
    var b75        = 25;
    var a2         = Age * Age;
    var a3         = a2 * Age;
    var a4         = a2 * a2;
    var hadj       = 0;
    if (form.Gender.selectedIndex == 1) {
        if (Age < 14) {
            b85 = 0.000283 * a4 - 0.01751 * a3 + 0.3673 * a2 - 2.3464 * Age + 21.352;
            b05 = -0.00016 * a4 + 0.00429 * a3 + 0.0043 * a2 - 0.4246 * Age + 15.107;
            b95 = 0.000485 * a4 - 0.0268 * a3 + 0.5096 * a2 - 2.926 * Age + 23.164;
        } else {
            b05 = 20 * (1 - Math.exp(-1 * (0.11 * Age)));
            b95 = (31.1 * Age) / (2.0 + Age);
            if (Age < 25) {
                if (form.cdc.selectedIndex == 0) {
                    b85 = 0.000283 * a4 - 0.01751 * a3 + 0.3673 * a2 - 2.3464 * Age + 21.352;
                } else {
                    b85 = 0.002855 * a3 - 0.1909 * a2 + 4.2262 * Age - 6.1898;
                }
            } else {
                b85 = (28.5 * (Age + 8)) / (5 + (Age + 8));
            }
        }
        if (Age < 12) {
            b75 = b85;
        } else {
            b75 = 24.5 * (1 - Math.exp(-0.1 * (Age + 10)));
        }
        if (Age > 22) {
            hadj = -1.6 + (3.2 / (1 + Math.pow(1.18, cm - 163.5)));
            hadj = hadj * (0.125 * Math.min(Age, 30) - 2.75);
            b85  = b85 + hadj;
            b95  = b95 + hadj;
            b05  = b05 + hadj;
            b75  = b75 + hadj;
        }
    } else {
        if (Age < 17) {
            b85 = 0.000223 * a4 - 0.0139 * a3 + 0.3082 * a2 - 2.105 * Age + 21.254;
            b05 = -0.000143 * a4 + 0.0037 * a3 + 0.015 * a2 - 0.5188 * Age + 15.677;
            b95 = 0.000536 * a4 - 0.0288 * a3 + 0.5394 * a2 - 3.2219 * Age + 23.811;
        } else {
            b05 = 20.7 * (1 - Math.exp(-1 * (0.115 * (Age - 0.9))));
            b85 = (29.1 * (Age - 8)) / (1.5 + (Age - 8));
            b95 = (33.3 * Age) / (2.9 + Age);
        }
        if (Age < 15) {
            b75 = b85;
        } else {
            b75 = 25.5 * (1 - Math.exp(-0.1 * (Age + 10)));
        }
    }
    if (form.cdc.selectedIndex == 0) {
        b95 = Math.min(b95, 30);
        b85 = Math.min(b85, 25);
        b75 = b85;
    }
    if (Age < 15) {
        b75 = b85;
    }
    var interp = "بدين";
    if (bmi < b95)interp = "وزن زائد";
    if (bmi < b85)interp = "زيادة خفيفة في الوزن";
    if (bmi < b75)interp = "ضمن الحدود الطبيعية";
    if (bmi < b05)interp = "نقص في الوزن";
    if (bmi < 13 || bmi > 50)interp = "تحقق من الأرقام المدخلة";
    form.interp.value = interp;
    var p05           = 0;
    var p10           = 0;
    var p25           = 0;
    var p50           = 0;
    var p75           = 0;
    var p90           = 0;
    var p95           = 0;
    var m             = 0;
    var b             = 0;
    var theP          = 0;
    var specific50    = 0;
    var diff50        = 0;
    a2                = cm * cm;
    a3                = a2 * cm;
    if (form.Gender.selectedIndex == 0) {
        if (cm < 125) {
            p05 = 0.0021 * a2 - 0.155 * cm + 8.2203;
            p10 = 0.0023 * a2 - 0.1823 * cm + 9.618;
            p25 = 0.0028 * a2 - 0.2744 * cm + 14.483;
            p50 = 0.0026 * a2 - 0.21 * cm + 10.8;
            p75 = 0.0037 * a2 - 0.3934 * cm + 19;
            p90 = 0.0058 * a2 - 0.7611 * cm + 35.6;
            p95 = 0.0082 * a2 - 1.2204 * cm + 58.051;
        } else {
            if (cm < 165) {
                p05 = 20 + (70 - 20) / (1 + (Math.pow(10, (158 - cm) * 0.04)));
                p10 = 23 + (67 - 23) / (1 + (Math.pow(10, (156 - cm) * 0.05)));
                p25 = 24 + (75 - 24) / (1 + (Math.pow(10, (156 - cm) * 0.05)));
                p50 = 22.9 + (89 - 22.9) / (1 + (Math.pow(10, (156 - cm) * 0.045)));
                p75 = 27.5 + (90 - 27.5) / (1 + (Math.pow(10, (153 - cm) * 0.055)));
                p90 = 30 + (94 - 30) / (1 + (Math.pow(10, (150 - cm) * 0.055)));
                p95 = 34.5 + (104 - 34.5) / (1 + (Math.pow(10, (151 - cm) * 0.056)));
            } else {
                p05 = 0.73 * cm - 67.96;
                p10 = 0.7928 * cm - 75.507;
                p25 = 0.8941 * cm - 86.397;
                p50 = 0.9165 * cm - 81.496;
                p75 = 1.1124 * cm - 105.3;
                p90 = 1.2251 * cm - 114.72;
                p95 = 1.2363 * cm - 108.84;
            }
        }
        specific50 = p50;
        if (Age > 18) {
            specific50 = (0.85 * cm) - (0.0086 * Age * Age - 0.9796 * Age + 92.781);
        } else {
            if (Age > 7) {
                specific50 = (17 + (80 - 17) / (1 + Math.pow(10, (154 - cm) * 0.03))) + Math.max((1.018 * Age - 15), 0) * Math.min((0.0278 * cm - 3.4722), 1);
            }
        }
        if (cm < 112) {
            specific50 = p50;
        }
    } else {
        if (cm < 125) {
            p05 = 0.0020 * a2 - 0.141 * cm + 8.0736;
            p10 = 0.0022 * a2 - 0.177 * cm + 10;
            p25 = 0.0016 * a2 - 0.0398 * cm + 2.9072;
            p50 = 0.0018 * a2 - 0.0554 * cm + 3.3595;
            p75 = 0.0033 * a2 - 0.3099 * cm + 14.6;
            p90 = 0.0045 * a2 - 0.46 * cm + 19.2;
            p95 = 0.0061 * a2 - 0.7332 * cm + 31.202;
        } else {
            if (cm < 161) {
                p05 = 21 + (53 - 21) / (1 + (Math.pow(10, (148 - cm) * 0.06)));
                p10 = 21.7 + (53 - 21.7) / (1 + (Math.pow(10, (146 - cm) * 0.07)));
                p25 = 22 + (60 - 22) / (1 + (Math.pow(10, (145 - cm) * 0.068)));
                p50 = 22 + (70 - 22) / (1 + (Math.pow(10, (143 - cm) * 0.065)));
                p75 = 25 + (82 - 25) / (1 + (Math.pow(10, (143 - cm) * 0.068)));
                p90 = 26 + (99 - 26) / (1 + (Math.pow(10, (142 - cm) * 0.06)));
                p95 = 28 + (107 - 28) / (1 + (Math.pow(10, (142 - cm) * 0.06)));
            } else {
                p05 = 0.6153 * cm - 50.992;
                p10 = 0.6759 * cm - 58.085;
                p25 = 0.6375 * cm - 45.456;
                p50 = 0.6261 * cm - 33.83;
                p75 = 0.6896 * cm - 30.833;
                p90 = 0.8127 * cm - 36.131;
                p95 = cm - 58;
            }
        }
        specific50 = p50;
        if (Age > 18) {
            specific50 = (0.6261 * cm) - (0.0094 * Age * Age - 1.1097 * Age + 59.183);
        } else {
            if (Age > 7) {
                specific50 = (13 + (75 - 13) / (1 + Math.pow(10, (150 - cm) * 0.026))) + Math.max((1.018 * Age - 13.234), 0) * Math.min((0.0278 * cm - 3.4722), 1);
            }
        }
        if (cm < 126) {
            specific50 = p50;
        }
    }
    diff50 = p50 - specific50;
    p05    = p05 - diff50;
    p10    = p10 - diff50;
    p25    = p25 - diff50;
    p50    = p50 - diff50;
    p75    = p75 - diff50;
    p90    = p90 - diff50;
    p95    = p95 - diff50;
    if (kg < p10) {
        m = (10 - 5) / (p10 - p05);
        b = 5 - (m * p05);
    } else {
        if (kg < p25) {
            m = (25 - 10) / (p25 - p10);
            b = 10 - (m * p10);
        } else {
            if (kg < p50) {
                m = (50 - 25) / (p50 - p25);
                b = 25 - (m * p25);
            } else {
                if (kg < p75) {
                    m = (75 - 50) / (p75 - p50);
                    b = 50 - (m * p50);
                } else {
                    if (kg < p90) {
                        m = (90 - 75) / (p90 - p75);
                        b = 75 - (m * p75);
                    } else {
                        m = (95 - 90) / (p95 - p90);
                        b = 90 - (m * p90);
                    }
                }
            }
        }
    }
    theP             = m * kg + b;
    form.kgcmP.value = SetPercentile(rounding(theP, 0));
    return null;
}
function GetAge(form, cm) {
    var tempAge = 35;
    if (form.AgeCat.selectedIndex == 0) {
        tempAge = 75;
    } else {
        if (form.AgeCat.selectedIndex < 6) {
            tempAge = 65 - (form.AgeCat.selectedIndex - 1) * 10;
        } else {
            if (form.AgeCat.selectedIndex == 6) {
                tempAge = 19;
            } else {
                if (form.AgeCat.selectedIndex < 23) {
                    tempAge = 17 - (form.AgeCat.selectedIndex - 7);
                } else {
                    if (form.AgeCat.selectedIndex == 23) {
                        tempAge = 1.5;
                    } else {
                        if (form.AgeCat.selectedIndex == 24) {
                            tempAge = 1;
                        } else {
                            if (form.AgeCat.selectedIndex == 25) {
                                tempAge = 35;
                            } else {
                                tempAge = 17.5;
                            }
                        }
                    }
                }
            }
        }
    }
    if (form.Gender.selectedIndex == 0) {
        if (cm < 155 && tempAge > 17) {
            tempAge = rounding(0.0003 * cm * cm + 0.0847 * cm - 7.5544, 1);
        }
    } else {
        if (cm < 145 && tempAge > 17) {
            tempAge = rounding(0.0007 * cm * cm - 0.0136 * cm - 1.6819, 1);
        }
    }
    form.Years.value = tempAge;
    return tempAge;
}
function SetAge(form) {
    if (form.Years.value > 0) {
        if (form.AgeCat.selectedIndex == 0) {
            form.Years.value = 75;
        } else {
            if (form.AgeCat.selectedIndex < 6) {
                form.Years.value = 65 - (form.AgeCat.selectedIndex - 1) * 10;
            } else {
                if (form.AgeCat.selectedIndex == 6) {
                    form.Years.value = 19;
                } else {
                    if (form.AgeCat.selectedIndex < 23) {
                        form.Years.value = 17 - (form.AgeCat.selectedIndex - 7);
                    } else {
                        if (form.AgeCat.selectedIndex == 23) {
                            form.Years.value = 1.5;
                        } else {
                            if (form.AgeCat.selectedIndex == 24) {
                                form.Years.value = 1;
                            } else {
                                if (form.AgeCat.selectedIndex == 25) {
                                    form.Years.value = 30;
                                } else {
                                    if (form.Years.value > 19)form.Years.value = "";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return true;
}
function SetAgeCat(form, tAge) {
    if (tAge > 69.99) {
        form.AgeCat.selectedIndex = 0;
    }
    else {
        if (tAge <= 1)form.AgeCat.selectedIndex = 24; else {
            if (tAge < 2)form.AgeCat.selectedIndex = 23; else {
                if (tAge < 18)form.AgeCat.selectedIndex = -Math.floor(tAge) + 24; else {
                    if (tAge < 20)form.AgeCat.selectedIndex = 6; else {
                        form.AgeCat.selectedIndex = Math.ceil(-1 * (tAge - 78.999)) / 10;
                    }
                }
            }
        }
    }
    return true;
}
function setFeetAndInches(form, inchies) {
    var feet               = Math.min(Math.max(Math.floor(inchies / 12), 1), 7);
    form.htf.selectedIndex = feet - 1;
    inchies                = rounding(inchies - feet * 12, 0);
    form.hti.selectedIndex = Math.min(Math.max(inchies, 0), 11);
    return true;
}
function feetAndInches(form) {
    var inchies = 0;
    inchies     = ((form.htf.selectedIndex + 1) * 12) + form.hti.selectedIndex;
    if (form.hu.selectedIndex == 0)form.ht.value = inchies;
    if (form.hu.selectedIndex == 1)form.ht.value = rounding(inchies * 2.54, 0);
    return true;
}
function SetPercentile(pc) {
    if (pc > 98) {
        pc = "> 98th percentile";
    }
    else {
        if (pc < 2) {
            pc = "< 2nd percentile";
        }
        else {
            if (pc == 11) {
                pc = "11th percentile";
            }
            else {
                if (pc == 12) {
                    pc = "12th percentile";
                }
                else {
                    if (pc == 13) {
                        pc = "13th percentile";
                    }
                    else {
                        if (rightDigit(pc) == 1) {
                            pc = pc + "st percentile";
                        }
                        else {
                            if (rightDigit(pc) == 2) {
                                pc = pc + "nd percentile";
                            }
                            else {
                                if (rightDigit(pc) == 3) {
                                    pc = pc + "rd percentile";
                                }
                                else {
                                    pc = pc + "th percentile";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return pc;
}
function poundsAndKilos(form) {
    var weight = Number(form.wt.value);
    if (weight > 0) {
        if (form.wu.selectedIndex == 0) {
            form.wt.value = rounding(weight / 0.45359237, 0);
        } else {
            if (weight > 219) {
                form.wt.value = rounding(weight * 0.45359237, 0);
            } else {
                form.wt.value = rounding(weight * 0.45359237, 1);
            }
        }
        form.wt.select();
        form.wt.focus();
    }
    return true;
}
function inchesCm(form) {
    var height = Number(form.ht.value);
    if (height > 0) {
        if (form.hu.selectedIndex == 0) {
            setFeetAndInches(form, height / 2.54);
            form.ht.value = rounding(height / 2.54, 1);
        } else {
            setFeetAndInches(form, height);
            form.ht.value = rounding(height * 2.54, 0);
        }
        form.ht.select();
        form.ht.focus();
    }
    return true;
}
function rightDigit(num) {
    num = num - (Math.floor(num / 10) * 10);
    return num;
}
function rounding(number, decimal) {
    multi  = Math.pow(10, decimal);
    number = Math.round(number * multi) / multi;
    return number;
}
function checkWeight(val) {
    if ((isNaN(val)) || (val == null) || (val == "") || (val < 0)) {
        alert("يرجى إدخال قيمة الوزن");
        return false;
    }
    return true;
}
function OpenLink(theURL) {
    window.open(theURL);
    return true;
}
function microsoftKeyPress() {
    if (window.event.keyCode == 13) {
        CalcIt(document.forms[0]);
    }
    return true;
}

// setTimeout("document.forms[0].wt.focus();", 1);