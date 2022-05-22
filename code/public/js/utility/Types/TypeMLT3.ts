export class TypeMLT3
{
    public static from4B5B(code4b5b: string): string
    {
        type modifier = "UP"|"DOWN";
        type mlt3     = "+"|"0"|"-";
        type binary   = "0"|"1"|" ";

        let output: string = "";
        let strArray: string[] = code4b5b.match(/./g);
        strArray = strArray || [""]; //wenn strArray ist null oder undefined, dann setz auf leeres array

        let currentModifier: modifier = "UP";
        let lastsymbol: mlt3 = "0";

        // @ts-ignore
        strArray.forEach(function (byte: binary)
        {
            if(byte == "0")
            {
                output += lastsymbol;
            }
            else if (byte == "1")
            {
                if (currentModifier == "UP")
                {
                    if (lastsymbol == "-")
                    {
                        output += "0";
                        lastsymbol = "0";
                        currentModifier = "UP";
                    }
                    else if (lastsymbol == "0")
                    {
                        output += "+";
                        lastsymbol = "+";
                        currentModifier = "DOWN";
                    }
                }
                else if (currentModifier == "DOWN")
                {
                    if (lastsymbol == "+")
                    {
                        output += "0";
                        lastsymbol = "0";
                        currentModifier = "DOWN";
                    }
                    else if (lastsymbol == "0")
                    {
                        output += "-";
                        lastsymbol = "-";
                        currentModifier = "UP";
                    }
                }
            }
            else if (byte == " ")
            {
                output += " ";
            }
        })

        return output.trim();
    }
}