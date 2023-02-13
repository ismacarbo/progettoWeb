/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package AllenamentoVinoUDPClient;

import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;
import java.net.UnknownHostException;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author INTEL
 */
public class Client {
    private DatagramSocket socket;
    private InetAddress indirizzo;
    private int porta;
    private byte[] bufferIN,bufferOUT;

    public Client(int porta,String ip) {
        try {
            this.porta = porta;
            socket=new DatagramSocket(porta);
            indirizzo=InetAddress.getByName(ip);
        } catch (SocketException ex) {
            System.out.println(ex.getMessage());
        } catch (UnknownHostException ex) {
            Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        bufferIN=new byte[1024];
        bufferOUT=new byte[1024];
        
    }
    
    public void comunica(){
        boolean fine=false;
        String ricevuto="",inviato="";
        DatagramPacket entrata,uscita;
        Scanner scan=new Scanner(System.in);
        while(!fine){
            try {
                int scelta=menu();
                switch(scelta){
                    case 1:
                        inviato+="I#";
                        System.out.println("Inserisci il codice del prodotto");
                        inviato+=scan.next();
                        bufferOUT=inviato.getBytes();
                        uscita=new DatagramPacket(bufferOUT, bufferOUT.length,indirizzo,porta);
                        socket.send(uscita);
                        break;
                    case 2:
                        inviato+="P#";
                        System.out.println("Inserisci il codice del prodotto");
                        inviato+=scan.next();
                        bufferOUT=inviato.getBytes();
                        uscita=new DatagramPacket(bufferOUT, bufferOUT.length,indirizzo,porta);
                        socket.send(uscita);
                        break;
                    case 3:
                        inviato+="I#";
                        System.out.println("Inserisci il codice del prodotto");
                        inviato+=scan.next();
                        System.out.println("Inserisci la quantità del prodotto");
                        inviato+=scan.next();
                        bufferOUT=inviato.getBytes();
                        uscita=new DatagramPacket(bufferOUT, bufferOUT.length,indirizzo,porta);
                        socket.send(uscita);
                        break;
                }
            } catch (IOException ex) {
                System.out.println(ex.getMessage());
            }
            
            entrata=new DatagramPacket(bufferIN, bufferIN.length);
            try {
                socket.receive(entrata);
            } catch (IOException ex) {
                Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
            }
            
            ricevuto=new String(entrata.getData());
            ricevuto=ricevuto.substring(0,entrata.getLength());
            System.out.println("DAL SERVER: "+ricevuto);
        }
    }
    
    private int menu(){
        System.out.println("1.Informazioni\n2.Prezzo.3.Acquista");
        return new Scanner(System.in).nextInt();
    }
    
    
}
