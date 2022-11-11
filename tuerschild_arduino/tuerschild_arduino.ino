#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <time.h>
#include <WiFiClient.h>
#include <WiFi.h>
#include <WiFiMulti.h>
#include "creds.h"


// GxEPD2_HelloWorld.ino by Jean-Marc Zingg

// see GxEPD2_wiring_examples.h for wiring suggestions and examples
// if you use a different wiring, you need to adapt the constructor parameters!

// uncomment next line to use class GFX of library GFX_Root instead of Adafruit_GFX
//#include <GFX.h>

#include <GxEPD2_BW.h>
#include <GxEPD2_3C.h>
#include <Fonts/FreeMonoBold24pt7b.h>
#include <Fonts/FreeMonoBold12pt7b.h>
#include <Fonts/FreeMonoBold9pt7b.h>
#include <U8g2_for_Adafruit_GFX.h>

// select the display class and display driver class in the following file (new style):
#include "GxEPD2_display_selection_new_style.h"

// or select the display constructor line in one of the following files (old style):
//#include "GxEPD2_display_selection.h"
//#include "GxEPD2_display_selection_added.h"

// alternately you can copy the constructor from GxEPD2_display_selection.h or GxEPD2_display_selection_added.h to here
// e.g. for Wemos D1 mini:
//GxEPD2_BW<GxEPD2_154_D67, GxEPD2_154_D67::HEIGHT> display(GxEPD2_154_D67(/*CS=D8*/ SS, /*DC=D3*/ 0, /*RST=D4*/ 2, /*BUSY=D2*/ 4)); // GDEH0154D67
U8G2_FOR_ADAFRUIT_GFX u8g2_for_adafruit_gfx;


String dateTime;
int dayOfWeek;
int currentHour;
int currentMinute;
int minutesTillTomorrow;
int minutesTillMonday;
int currentPeriod;
int currentTime;
DynamicJsonDocument doc(2048);

String IP = API_BASE+"/api/getRoomInfo.php?id=";
int roomNum;

IPAddress gateway(10,0,0,1);
IPAddress dns(10,0,0,1);
IPAddress subnet(255,0,0,0);
IPAddress ip(10,0,144,69);

void anzeige(String room,String z1,String z2,String zr1,String zr2,String zr3,String zr4,int h1,int h2,int h3,int h4,String date){
display.setRotation(1);
  display.fillScreen(GxEPD_WHITE);
  u8g2_for_adafruit_gfx.begin(display);
    u8g2_for_adafruit_gfx.setFont(u8g2_font_fub30_tf);  // select u8g2 font from here: https://github.com/olikraus/u8g2/wiki/fntlistall
  u8g2_for_adafruit_gfx.setFontMode(1);                 // use u8g2 transparent mode (this is default)
  u8g2_for_adafruit_gfx.setFontDirection(0);            // left to right (this is default)
  u8g2_for_adafruit_gfx.setForegroundColor(GxEPD_BLACK);      // apply Adafruit GFX color
  u8g2_for_adafruit_gfx.setCursor(0,20);                // start writing at this position
     u8g2_for_adafruit_gfx.setCursor(30, 40);
    u8g2_for_adafruit_gfx.print(room);
    
    u8g2_for_adafruit_gfx.setFont(u8g2_font_helvR14_tf);
    u8g2_for_adafruit_gfx.setFontMode(1);                 // use u8g2 transparent mode (this is default)
     u8g2_for_adafruit_gfx.setCursor(30, 65);
    u8g2_for_adafruit_gfx.print(z1);
    u8g2_for_adafruit_gfx.setCursor(30, 90);
    u8g2_for_adafruit_gfx.print(z2);
     u8g2_for_adafruit_gfx.setCursor(165, 25);
    u8g2_for_adafruit_gfx.print(zr1);
     u8g2_for_adafruit_gfx.setCursor(165, 55);
   u8g2_for_adafruit_gfx.print(zr2);
     u8g2_for_adafruit_gfx.setCursor(165,85);
   u8g2_for_adafruit_gfx.print(zr3);
    u8g2_for_adafruit_gfx.setCursor(165,115);
   u8g2_for_adafruit_gfx.print(zr4);
     u8g2_for_adafruit_gfx.setCursor(140,25);
    u8g2_for_adafruit_gfx.print((String)h1+".");
     u8g2_for_adafruit_gfx.setCursor(140, 55);
    u8g2_for_adafruit_gfx.print((String)h2+".");
     u8g2_for_adafruit_gfx.setCursor(140, 85);
   u8g2_for_adafruit_gfx.print((String)h3+".");
   u8g2_for_adafruit_gfx.setCursor(140, 115);
   u8g2_for_adafruit_gfx.print((String)h4+".");
    u8g2_for_adafruit_gfx.setFont(u8g2_font_courB08_tf );
    u8g2_for_adafruit_gfx.setFontMode(1);                 // use u8g2 transparent mode (this is default)
     u8g2_for_adafruit_gfx.setCursor(5 , 125);
    u8g2_for_adafruit_gfx.print(date);
    
    //Baterie
    u8g2_for_adafruit_gfx.setFont(u8g2_font_battery19_tn);
    u8g2_for_adafruit_gfx.setFontMode(1);                 
     u8g2_for_adafruit_gfx.setCursor(10 , 120);
    u8g2_for_adafruit_gfx.print("a");

 
    
 //display.drawLine(135, 0, 135, 300, GxEPD_RED);
  display.drawLine(160, 25, 270, 25, GxEPD_BLACK);
   display.drawLine(160, 55, 270, 55, GxEPD_BLACK);
    display.drawLine(160, 85, 270, 85, GxEPD_BLACK);
     display.drawLine(160, 115, 270, 115, GxEPD_BLACK);
  display.display(); // make everything visible  
 // display.hibernate();


}

int getMinutesTill750(int cHour,int  cMinute){
  int hours;
  if(cHour <= 7){
    hours=7-cHour;
  }else{
    hours=(24-cHour + 7);
  }
  return hours*60 + (50-cMinute);
}

void setClock() {  
  dayOfWeek = int(doc["time"]["day"]);
  currentHour = int(doc["time"]["hour"]);
  currentMinute = int(doc["time"]["minute"]);

  minutesTillTomorrow = getMinutesTill750(currentHour, currentMinute); //Minutes till 7:50 AM the next day
  //minutesTillMonday = ((7 - currentHour)*60) + (50 - currentMinute) + ((7-dayOfWeek)*1440); //Minutes till Mo 7:50 AM

  String currentTimeString = String(currentHour) + String(currentMinute);
  currentTime = currentTimeString.toInt();
  currentPeriod = int(doc["current_period"]);
}


void doSleep(uint64_t min){
      esp_sleep_enable_timer_wakeup(min*60*1000*1000ull);
      esp_deep_sleep_start();  
}


void maybeSleep() { 
  Serial.print("Wochentag: ");
  Serial.println(dayOfWeek);
  Serial.print("Stunde: ");
  Serial.println(currentHour);
    Serial.print("Minute: ");
  Serial.println(currentMinute);
  Serial.print("minutestilltommorow: ");
  Serial.println(minutesTillTomorrow);
  
  


  if(dayOfWeek == 5){ //Friday 
    if(currentHour >= 15){
      Serial.println("Long sleep");
      
      doSleep(48*60);
    }
  }
  
/*  if(dayOfWeek == 6){ //Saturday and Sunday
    Serial.println("Long sleep");
    
    esp_sleep_enable_timer_wakeup(minutesTillMonday*60000000);
    esp_deep_sleep_start();
  }*/

  if(((dayOfWeek >= 1 || dayOfWeek <= 4) && currentHour >= 15) || dayOfWeek == 7|| dayOfWeek == 6){ //Monday to Thursday
      Serial.println("Long sleep");
      Serial.println(minutesTillTomorrow);
      doSleep(minutesTillTomorrow);
  }
  
}

boolean loadTimeTable() {
  if((WiFi.status() == WL_CONNECTED)) {

        HTTPClient http;

        Serial.print("[HTTP] begin...\n");
        // configure traged server and url
        http.begin(IP+roomID); //HTTP

        Serial.print("[HTTP] GET...\n");
        // start connection and send HTTP header
        int httpCode = http.GET();
        Serial.printf("[HTTP] GET... code: %d\n", httpCode);
        
        // httpCode will be negative on error
        // file found at server
        if(httpCode == HTTP_CODE_OK) {
                String payload = http.getString();
                deserializeJson(doc, payload);
                return true;
        }
        http.end();
   }
   return false;
}

void setup()
{
  Serial.begin(115200);

  long t = millis();
  
  WiFi.persistent(false);
 // WiFi.config(ip, dns, gateway, subnet);
  WiFi.begin(WIFI_SSID, WIFI_PWD);

  // wait for WiFi connection
  Serial.print("Waiting for WiFi to connect...");
  while ((WiFi.status() != WL_CONNECTED)) {
  }
  Serial.println(" connected to wifi");

 
  if (loadTimeTable()) {
    Serial.println("ERROR LOL");
    Serial.println((millis() - t) / 1000.0);
    doSleep(95);
  }
  setClock();
  
  maybeSleep();
  display.init();
  Serial.println(doc["room_no"].as<String>());

  Serial.println((millis() - t) / 1000.0);
  anzeige(doc["room_no"].as<String>(),doc["room_z1"].as<String>(),doc["room_z2"].as<String>(), doc["timetable_z1"].as<String>(), doc["timetable_z2"].as<String>(), doc["timetable_z3"].as<String>(), doc["timetable_z4"].as<String>(), currentPeriod, currentPeriod + 1, currentPeriod + 2, currentPeriod + 3, String(currentHour) + ":" + String(currentMinute) + " - " + String(dayOfWeek));

  Serial.println("Short sleep");
  
  Serial.println((millis() - t) / 1000.0);
  doSleep(95);
  
}



void loop() {};
