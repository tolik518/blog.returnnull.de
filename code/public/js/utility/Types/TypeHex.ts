export class TypeHex
{
    public static fromAscii(ascii: string): string
    {
        let hex: string[] = ascii.split('') //https://stackoverflow.com/a/38362821
            .map((char: any) => ''.concat(char.charCodeAt(0).toString(16)).slice(-8))
            .join('').match(/.{2}/g);
        hex = hex || [""]; //wenn binary ist null oder undefined, dann setz auf leeres array

        let output: string = "";

        hex.forEach(function (bytes: string) {
            output+= bytes + " ";
        })
        return output.trim();
    }

    public static fromBinary(binary: string): string
    {
        let output: string = "";

        if(binary == "")
        {
            output = "";
        } else {
            let hex: string[] = binary.trim().split(' ');

            hex.forEach(function (bytes: string) {
                output += parseInt(bytes, 2).toString(16).toUpperCase().replace(/NAN/g, "?");
            })
            output = output.match(/.{1,2}/g).join(' '); //leerzeichen nach 2 symbolen hinzufügen
        }
        return output.trim();
    }
}