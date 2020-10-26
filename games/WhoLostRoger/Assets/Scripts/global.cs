using System.Collections;
using System.Collections.Generic;
using UnityEngine;

/*
 * This component script is used for generate static varible to initialize   
 * some gameObject.
 * 
 * In Unity inspector,
 * @require bool           isPause   
 * @require string         nowSceneName
 * @require float          bgVolumn
 * @require float          soundVolumn
 */
public static class global
{
    // public static string selectedNoun="";

    // public static string selectedNounObject="";

    public static bool isPause=false;
    public static string nowSceneName="Scene_SpookyRoom01";

    public static float bgVolumn=1f;
    public static float soundVolumn=1f;
    
}
