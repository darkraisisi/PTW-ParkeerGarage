// defines arduino pins numbers
const int trigPin = 3;
const int echoPin = 4;
const int buttonPin = 5;
// defines variables
long duration;
int distance;
void setup() 
{  
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin, INPUT); // Sets the echoPin as an Input
    
  Serial.begin(9600); // Starts the serial communication
}
void loop() {
  pinMode(buttonPin, INPUT_PULLUP);
    while (digitalRead(buttonPin) == HIGH)
    {
      delay(10);   
    }
  // Clears the trigPin
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration = pulseIn(echoPin, HIGH);
  // Calculating the distance
  distance= duration*0.034/2;
  // Prints the distance on the Serial Monitor
  //Serial.print("Distance from the object = ");
  if(distance < 2400){
    Serial.println(distance);
    Serial.print(" ");
    //Serial.println(" cm");  
    //delay(10);
  }
}
