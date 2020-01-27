import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Tab2Page } from './tab2.page';

interface Garage {
  id: number;
  name: string;
  place: string;
}

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    RouterModule.forChild([{ path: '', component: Tab2Page }])
  ],
  declarations: [Tab2Page]
})

export class Tab2PageModule {
  garages = Array<Garage>();
  constructor() {
    this.garages = [{ id: 1, name: 'Utrecht Centraal', place: 'Utrecht' }, { id: 2, name: 'Utrecht Overvecht', place: 'Utrecht' }];
  }
}
