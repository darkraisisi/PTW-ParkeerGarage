import { Component, } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

interface Garage {
  id: number;
  name: string;
  place: string;
}

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})

export class Tab2Page {

  garages: Array<Garage> = [];
  allGarages: Array<Garage> = [];
  favGarage: Garage;
  serverurl = 'http://145.89.160.167/ptw/server/';
  // serverurl = 'http://localhost/ptw/server/';
  error = 0
  SECRET = "6423834HeuEHUADd679ii7e67990YEu"

  constructor(private http: HttpClient) {
    this.favGarage = JSON.parse(localStorage.getItem('favorite'))

  }
  
  ngOnInit(){
    this.getAllGarages()
  }
  getAllGarages() {
    const formData = new FormData()
    var nowTime = this.timeInMiliseconds()
    let httpOptions = {
      headers : new HttpHeaders({
        'Content-Type':  'application/json',
        'Access-Control-Allow-Origin': '*'
      })
    };
    httpOptions.headers.set('Authorization', 'my-new-auth-token');
    this.generateHash(nowTime).then((hash) => {
      formData.append('hash',hash)
      formData.append('verify_time',nowTime.toString())
      this.http.post(this.serverurl + 'spot/get_all_garages',formData).subscribe((data:Array<Garage>) => {
        console.log(data)
        this.allGarages = data
        this.garages = data
      },error=>{
        console.log(error)
        this.error = 404
      })
    })
  }
  generateHash(nowTime): PromiseLike<string> {
    
    const encoder = new TextEncoder();
    const data = encoder.encode(nowTime + this.SECRET);
    return crypto.subtle.digest('SHA-256', data).then(hashBuffer => {
      const hashArray = Array.from(new Uint8Array(hashBuffer));
      const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
      return hashHex;
    });
  }
  timeInMiliseconds(): number {
    return Date.now()
  }

  search(event) {
    let input = event.target.value.toLowerCase();
    this.garages = [];
    this.allGarages.forEach((garage: Garage) => {
      if (garage.name.toLocaleLowerCase().indexOf(input) > -1 || garage.place.toLocaleLowerCase().indexOf(input) > -1) {
        this.garages.push(garage)
      }
    });
  }

  setFavorite(garage) {
    if (this.favGarage == garage) {
      this.favGarage = null
    } else {
      this.favGarage = garage
    }
    localStorage.setItem('favorite',JSON.stringify(this.favGarage))
  }

  isEqual(currgar){
    if(this.favGarage.name == currgar.name){
      console.log(currgar)
      return true
    }else{
      return false
    }
  }

}
