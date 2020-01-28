import { Component } from '@angular/core';
import { HTTP, HTTPResponse } from '@ionic-native/http/ngx';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

interface Garage {
  id: number;
  name: string;
  place: string;
}

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page {

  favGarage: Garage;
  freeSpaces = 0;
  serverurl = 'http://192.168.178.173/ptw/server/';
  // serverurl = 'http://localhost/ptw/server/';

  SECRET = "6423834HeuEHUADd679ii7e67990YEu"

  constructor(private http: HttpClient) {

  }
  ionViewDidEnter() {
    this.favGarage = JSON.parse(localStorage.getItem('favorite'))
    console.log(this.favGarage)
    // this.freeSpaces = this.getFreeSpacesFromGarage(this.favGarage.id);
    this.getFreeSpacesFromGarage(this.favGarage.id)
  }
  getFreeSpacesFromGarage(id: number) {
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
      formData.append('garage_id',id.toString())
      this.http.post(this.serverurl + 'spot/get_amount_free_from_garage',formData).subscribe((data:number) => {
        this.freeSpaces = data
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
}
