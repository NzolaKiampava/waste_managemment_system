#include <SoftwareSerial.h>   
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>


const int trigger = 4;
const int echo = 5;
float times=0;
int distance=0;
// Replace with your network credentials
const char* ssid     = "KiampavaTheCoder";
const char* password = "nzoladeveloper";


void setup() {
  Serial.begin(115200);
  Serial.print("Connecting to ");
  Serial.println(ssid);
  pinMode(trigger,OUTPUT);
  pinMode(echo,INPUT);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected.");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

}



void loop() {

  digitalWrite(trigger,LOW);
 delayMicroseconds(2);
 digitalWrite(trigger,HIGH);
 delayMicroseconds(10);
 digitalWrite(trigger,LOW);
 delayMicroseconds(2);
 times=pulseIn(echo,HIGH);
 int distance=times*340/20000;

 //Serial.println("Distance:");
 Serial.println(distance);
 //Serial.println(" cm");
  if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
 
    HTTPClient http;  //Declare an object of class HTTPClient
  
    http.begin("http://192.168.43.23/ultrasonic_wastems/data.php?cm="+String(distance));  //Specify request destination
    
    int httpCode = http.GET();                                  //Send the request
  
    if (httpCode > 0) { //Check the returning code
 
      String payload = http.getString();   //Get the request response payload
      Serial.println(payload);             //Print the response payload
 
    }
 
    http.end();   //Close connection
 
  }
 
  delay(1000);    //Send a request every 30 seconds
}