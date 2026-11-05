export interface Holiday { date: string; weekday: string; scope?: 'national' | 'regional'; name_es: string; name_en: string; }
export interface Source { label: string; url: string; }
export interface Region { code: string; name: string; }
export const year: number;
export function national(): Holiday[];
export function regions(): Region[];
export function holidays(region?: string): Holiday[];
export function source(region: string): Source;
export function isHoliday(date: string | Date, region?: string): Holiday | null;
export function nextHoliday(region?: string, from?: string | Date): Holiday | null;
export const data: any;
