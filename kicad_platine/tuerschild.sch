EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title ""
Date ""
Rev ""
Comp ""
Comment1 ""
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L Regulator_Linear:MCP1700-3002E_SOT89 LDO1
U 1 1 6165BA5F
P 1900 3200
F 0 "LDO1" H 1900 3442 50  0000 C CNN
F 1 "MCP1700-3002E_SOT-23" H 1900 3351 50  0000 C CNN
F 2 "Package_TO_SOT_SMD:SOT-23" H 1900 3400 50  0001 C CNN
F 3 "http://ww1.microchip.com/downloads/en/DeviceDoc/20001826D.pdf" H 1900 3150 50  0001 C CNN
	1    1900 3200
	1    0    0    -1  
$EndComp
Wire Wire Line
	2200 3200 2250 3200
$Comp
L RF_Module:ESP32-WROOM-32 ESP1
U 1 1 6165AFCC
P 3950 2850
F 0 "ESP1" H 3950 4431 50  0000 C CNN
F 1 "ESP32-WROOM-32" H 3950 4340 50  0000 C CNN
F 2 "RF_Module:ESP32-WROOM-32" H 3950 1350 50  0001 C CNN
F 3 "https://www.espressif.com/sites/default/files/documentation/esp32-wroom-32_datasheet_en.pdf" H 3650 2900 50  0001 C CNN
	1    3950 2850
	1    0    0    -1  
$EndComp
$Comp
L SGM809-TXN3L:SGM809-TXN3L IC1
U 1 1 618969CE
P 2650 2600
F 0 "IC1" H 3400 2865 50  0000 C CNN
F 1 "SGM809-TXN3L" H 3400 2774 50  0000 C CNN
F 2 "Package_TO_SOT_SMD:SOT-23" H 4000 2700 50  0001 L CNN
F 3 "" H 4000 2600 50  0001 L CNN
F 4 "Microprocessor Supervisory Circuit in 3-Pin SOT23" H 4000 2500 50  0001 L CNN "Description"
F 5 "1.15" H 4000 2400 50  0001 L CNN "Height"
F 6 "SG-MICRO" H 4000 2300 50  0001 L CNN "Manufacturer_Name"
F 7 "SGM809-TXN3L" H 4000 2200 50  0001 L CNN "Manufacturer_Part_Number"
F 8 "" H 4000 2100 50  0001 L CNN "Mouser Part Number"
F 9 "" H 4000 2000 50  0001 L CNN "Mouser Price/Stock"
F 10 "" H 4000 1900 50  0001 L CNN "Arrow Part Number"
F 11 "" H 4000 1800 50  0001 L CNN "Arrow Price/Stock"
	1    2650 2600
	-1   0    0    1   
$EndComp
Wire Wire Line
	2550 1450 3950 1450
Wire Wire Line
	2650 2500 2650 2250
Wire Wire Line
	2650 2250 2400 2250
Wire Wire Line
	3350 1650 3250 1650
Wire Wire Line
	3250 1650 3250 2150
Wire Wire Line
	3250 2150 2900 2150
Wire Wire Line
	2550 2050 2550 3200
Connection ~ 2550 2050
Wire Wire Line
	2550 2050 2400 2050
$Comp
L Connector:Conn_01x09_Male J1
U 1 1 619069BD
P 2200 1850
F 0 "J1" H 2308 2431 50  0000 C CNN
F 1 "Conn_01x09_Male" H 2308 2340 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x09_P2.54mm_Horizontal" H 2200 1850 50  0001 C CNN
F 3 "~" H 2200 1850 50  0001 C CNN
	1    2200 1850
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R1
U 1 1 61916D2A
P 2900 2250
F 0 "R1" H 2959 2296 50  0000 L CNN
F 1 "R_Small" H 2959 2205 50  0000 L CNN
F 2 "Resistor_SMD:R_1206_3216Metric_Pad1.42x1.75mm_HandSolder" H 2900 2250 50  0001 C CNN
F 3 "~" H 2900 2250 50  0001 C CNN
	1    2900 2250
	1    0    0    -1  
$EndComp
Connection ~ 2900 2150
Wire Wire Line
	2900 2150 2400 2150
Wire Wire Line
	2650 2600 2700 2600
Wire Wire Line
	2900 2600 2900 2350
Connection ~ 2650 2600
Wire Wire Line
	4550 1650 4550 1400
Wire Wire Line
	2600 1400 2600 1950
Wire Wire Line
	2600 1950 2400 1950
Wire Wire Line
	2700 2600 2700 1850
Wire Wire Line
	2700 1850 2500 1850
Connection ~ 2700 2600
Wire Wire Line
	2700 2600 2900 2600
Wire Wire Line
	4550 1750 4600 1750
Wire Wire Line
	4600 1750 4600 1350
Wire Wire Line
	4600 1350 2650 1350
Wire Wire Line
	2650 1350 2650 1750
Wire Wire Line
	2650 1750 2400 1750
Wire Wire Line
	4550 1950 4650 1950
Wire Wire Line
	4650 1950 4650 1300
Wire Wire Line
	4650 1300 2700 1300
Wire Wire Line
	2700 1300 2700 1650
Wire Wire Line
	2700 1650 2400 1650
Wire Wire Line
	2550 1450 2550 2050
Wire Wire Line
	2400 1450 2550 1450
Connection ~ 2550 1450
Wire Wire Line
	2500 1850 2500 1550
Wire Wire Line
	2500 1550 2400 1550
Connection ~ 2500 1850
Wire Wire Line
	2500 1850 2400 1850
$Comp
L Device:CP C1
U 1 1 6192007B
P 2250 3350
F 0 "C1" H 2368 3396 50  0000 L CNN
F 1 "CP" H 2368 3305 50  0000 L CNN
F 2 "Capacitor_THT:CP_Radial_D6.3mm_P2.50mm" H 2288 3200 50  0001 C CNN
F 3 "~" H 2250 3350 50  0001 C CNN
	1    2250 3350
	1    0    0    -1  
$EndComp
Connection ~ 2250 3200
Wire Wire Line
	2250 3200 2550 3200
Wire Wire Line
	2250 3500 1900 3500
$Comp
L Device:R_Small R2
U 1 1 61921B1D
P 4450 1400
F 0 "R2" V 4254 1400 50  0000 C CNN
F 1 "R_Small" V 4345 1400 50  0000 C CNN
F 2 "Resistor_SMD:R_1206_3216Metric_Pad1.42x1.75mm_HandSolder" H 4450 1400 50  0001 C CNN
F 3 "~" H 4450 1400 50  0001 C CNN
	1    4450 1400
	0    1    1    0   
$EndComp
Wire Wire Line
	4350 1400 2600 1400
Wire Wire Line
	3950 1450 4700 1450
Wire Wire Line
	4700 1450 4700 2200
Connection ~ 3950 1450
Wire Wire Line
	3950 4250 4750 4250
Wire Wire Line
	4750 4250 4750 3750
Connection ~ 3950 4250
Wire Wire Line
	4800 2000 4800 3250
Wire Wire Line
	4800 3250 4550 3250
Wire Wire Line
	4750 1900 4750 1750
Wire Wire Line
	4750 1750 4600 1750
Connection ~ 4600 1750
Wire Wire Line
	4850 1800 4850 2150
Wire Wire Line
	4850 2150 4550 2150
Wire Wire Line
	4900 1700 4900 3150
Wire Wire Line
	4900 3150 4550 3150
Wire Wire Line
	4950 1600 4950 3050
Wire Wire Line
	4950 3050 4550 3050
Wire Wire Line
	4950 1600 5100 1600
Wire Wire Line
	4900 1700 5100 1700
Wire Wire Line
	4850 1800 5100 1800
Wire Wire Line
	4750 1900 5100 1900
Wire Wire Line
	4800 2000 5100 2000
Wire Wire Line
	4750 2100 5100 2100
Wire Wire Line
	4700 2200 5100 2200
Wire Wire Line
	5100 1500 5000 1500
Wire Wire Line
	5000 1500 5000 2050
Wire Wire Line
	5000 2050 4550 2050
$Comp
L Connector:Conn_01x08_Female E-Ink1
U 1 1 6165F234
P 5300 1800
F 0 "E-Ink1" H 5328 1776 50  0000 L CNN
F 1 "Conn_01x08_Female" H 5328 1685 50  0000 L CNN
F 2 "Connector_PinSocket_2.54mm:PinSocket_1x08_P2.54mm_Vertical" H 5300 1800 50  0001 C CNN
F 3 "~" H 5300 1800 50  0001 C CNN
	1    5300 1800
	1    0    0    -1  
$EndComp
NoConn ~ 3350 1850
NoConn ~ 3350 1950
NoConn ~ 4550 1850
NoConn ~ 4550 2250
NoConn ~ 4550 2350
NoConn ~ 4550 2450
NoConn ~ 4550 2850
NoConn ~ 4550 2950
NoConn ~ 4550 3350
NoConn ~ 4550 3450
NoConn ~ 4550 3650
NoConn ~ 4550 3750
NoConn ~ 4550 3850
NoConn ~ 4550 3950
NoConn ~ 3350 3350
NoConn ~ 3350 3250
NoConn ~ 3350 3150
NoConn ~ 3350 3050
NoConn ~ 3350 2950
NoConn ~ 3350 2850
$Comp
L Connector:Conn_01x03_Male J2
U 1 1 61A4F796
P 5300 2650
F 0 "J2" H 5272 2582 50  0000 R CNN
F 1 "Conn_01x03_Male" H 5272 2673 50  0000 R CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x03_P2.54mm_Horizontal" H 5300 2650 50  0001 C CNN
F 3 "~" H 5300 2650 50  0001 C CNN
	1    5300 2650
	-1   0    0    1   
$EndComp
Wire Wire Line
	4550 2750 5100 2750
Wire Wire Line
	5100 2650 4550 2650
Wire Wire Line
	4550 2550 5100 2550
Wire Wire Line
	2650 2600 2650 4250
$Comp
L Connector:Conn_01x02_Female Batt1
U 1 1 61A7318A
P 1900 4450
F 0 "Batt1" V 1746 4498 50  0000 L CNN
F 1 "Conn_01x02_Female" V 1837 4498 50  0000 L CNN
F 2 "Connector_PinSocket_2.54mm:PinSocket_1x02_P2.54mm_Vertical" H 1900 4450 50  0001 C CNN
F 3 "~" H 1900 4450 50  0001 C CNN
	1    1900 4450
	0    1    1    0   
$EndComp
Wire Wire Line
	2650 4250 3950 4250
Wire Wire Line
	1900 4250 1900 3500
Connection ~ 1900 3500
Wire Wire Line
	1900 4250 2650 4250
Connection ~ 1900 4250
Connection ~ 2650 4250
Wire Wire Line
	1800 4250 1150 4250
Wire Wire Line
	1150 2600 1150 3200
Wire Wire Line
	1150 3200 1600 3200
Connection ~ 1150 3200
Wire Wire Line
	1150 3200 1150 4250
$Comp
L Device:R_Small R3
U 1 1 61B7AC2B
P 4850 3650
F 0 "R3" H 4909 3696 50  0000 L CNN
F 1 "R_Small" H 4909 3605 50  0000 L CNN
F 2 "Resistor_SMD:R_1206_3216Metric_Pad1.42x1.75mm_HandSolder" H 4850 3650 50  0001 C CNN
F 3 "~" H 4850 3650 50  0001 C CNN
	1    4850 3650
	1    0    0    -1  
$EndComp
Wire Wire Line
	4550 3550 4850 3550
$Comp
L Device:R_Small R4
U 1 1 61B821B1
P 4950 3550
F 0 "R4" V 4754 3550 50  0000 C CNN
F 1 "R_Small" V 4845 3550 50  0000 C CNN
F 2 "Resistor_SMD:R_1206_3216Metric_Pad1.42x1.75mm_HandSolder" H 4950 3550 50  0001 C CNN
F 3 "~" H 4950 3550 50  0001 C CNN
	1    4950 3550
	0    1    1    0   
$EndComp
Connection ~ 4850 3550
Wire Wire Line
	4850 3750 4750 3750
Connection ~ 4750 3750
Wire Wire Line
	4750 3750 4750 2100
Wire Wire Line
	5050 3550 5050 4550
Wire Wire Line
	5050 4550 1150 4550
Wire Wire Line
	1150 4550 1150 4250
Connection ~ 1150 4250
$Comp
L Connector:Conn_01x04_Male J3
U 1 1 61D25D2A
P 5300 3100
F 0 "J3" H 5272 2982 50  0000 R CNN
F 1 "Conn_01x04_Male" H 5272 3073 50  0000 R CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x04_P2.54mm_Horizontal" H 5300 3100 50  0001 C CNN
F 3 "~" H 5300 3100 50  0001 C CNN
	1    5300 3100
	-1   0    0    1   
$EndComp
Wire Wire Line
	4750 4250 5300 4250
Wire Wire Line
	5300 4250 5300 3300
Wire Wire Line
	5300 3300 5100 3300
Wire Wire Line
	5100 3300 5100 3200
Connection ~ 4750 4250
Wire Wire Line
	5100 3100 5100 3200
Connection ~ 5100 3200
Wire Wire Line
	4700 1450 4850 1450
Wire Wire Line
	4850 1450 4850 1250
Wire Wire Line
	4850 1250 6300 1250
Wire Wire Line
	6300 1250 6300 2900
Wire Wire Line
	6300 2900 5100 2900
Connection ~ 4700 1450
Wire Wire Line
	5100 3000 5100 2900
Connection ~ 5100 2900
$EndSCHEMATC
