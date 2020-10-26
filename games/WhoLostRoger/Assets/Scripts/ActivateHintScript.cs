using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class ActivateHintScript : MonoBehaviour
{
//  hintString is used to store strings of each hint
    public string[] hintString = new string[]{
        "Carafe – Used to hold beverages",
        "Cloud – Droplets formed in the sky",
        "Framed Art – Somewhere in drawers",
        "Futon – A type of soft, flexible mattress",
        "Marigold – A type of plant",
        "Memoir – It has words in it",
        "Spume – Usually found in water",
        "Swan – A bird",
        "Valise – Travellers carry it",
        "Each click outside of the objects will have a time penalty.",
        "If you click on the text, you can hear what they sound like."
        };
    private string hintStringOne;
    private Text hintText;
    
//  Method is invoked using an OnClick function to generate a random number assigned to hintString and display the string
    public void clickHint(Text hintText) {
        int hintIndex = Random.Range(0, hintString.Length);
        hintStringOne= hintString[hintIndex];
        hintText.text = hintStringOne;
    }
}
